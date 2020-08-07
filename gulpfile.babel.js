import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import zip from 'gulp-zip';
import replace from 'gulp-replace';
import wpPot from 'gulp-wp-pot';
import info from './package.json';

const PRODUCTION = yargs.argv.prod;

/**
 * Browser sync
 */
const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: 'https://ims-houston.local', // put your local website link here
  });
  done();
};
export const reload = done => {
  server.reload();
  done();
};

/**
 * Process CSS
 */
export const styles = done => {
  src('src/scss/bundle.scss')
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: 'ie8' })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest('dist/css'))
    .pipe(server.stream());
  done();
};

/**
 * Bundle JavaScript
 */
export const scripts = done => {
  src(['src/js/bundle.js', 'src/js/admin.js'])
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: 'babel-loader',
                options: {
                  presets: [],
                },
              },
            },
          ],
        },
        mode: PRODUCTION ? 'production' : 'development',
        devtool: !PRODUCTION ? 'inline-source-map' : false,
        output: {
          filename: '[name].js',
        },
        externals: {
          jquery: 'jQuery',
        },
      })
    )
    .pipe(dest('dist/js'));
  done();
};

/**
 * Process images
 */
export const images = done => {
  src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest('dist/images'));
  done();
};

/**
 * Copy theme files to dist folder
 */
export const copy = done => {
  src(['src/**/*', '!src/{images,js,scss}', '!src/{images,js,scss}/**/*']).pipe(
    dest('dist')
  );
  done();
};

/**
 * Delete our dist folder
 */
export const clean = () => del(['dist']);

/**
 * Watch for changes and process
 */
export const watchForChanges = () => {
  watch('src/scss/**/*.scss', styles);
  watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
  watch(
    ['src/**/*', '!src/{images,js,scss}', '!src/{images,js,scss}/**/*'],
    series(copy, reload)
  );
  watch('src/js/**/*.js', series(scripts, reload));
  watch('**/*.php', reload);
};

/**
 * Translate our theme
 */
export const pot = done => {
  src('**/*.php')
    .pipe(
      wpPot({
        domain: '_themename',
        package: info.name,
      })
    )
    .pipe(dest(`languages/${info.name}.pot`));
  done();
};

/**
 * Create a zipped file of the production theme
 */
export const compress = done => {
  src([
    '**/*',
    '!node_modules{,/**}',
    '!bundled{,/**}',
    '!src{,/**}',
    '!.babelrc',
    '!.gitignore',
    '!gulpfile.babel.js',
    '!package.json',
    '!package-lock.json',
  ])
    .pipe(
      gulpif(
        file => file.relative.split('.').pop() !== 'zip',
        replace('_themename', info.name)
      )
    )
    .pipe(zip(`${info.name}.zip`))
    .pipe(dest('bundled'));
  done();
};
/**
 * Compose our tasks together
 */
export const dev = series(
  clean,
  parallel(styles, images, copy, scripts),
  serve,
  watchForChanges
);
export const build = series(
  clean,
  parallel(styles, images, copy, scripts),
  pot,
  compress
);
export default dev;
