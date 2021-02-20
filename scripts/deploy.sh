#!/bin/bash

set -e

# Setup site vars
REPO_URL="git@github.com:LayaTaal/ims-houston.git"
STAGING_ENV="imshstaging@imshstaging.ssh.wpengine.net"
PROD_ENV="imsproduction@imsproduction.ssh.wpengine.net"
BUILD_DIR="build"

# Select an environment
echo "Select the environment to deploy to (staging/prod)"
read -p "Environment: " deploy_env
echo Deploying to $deploy_env

# Check for existing directory and cleanup
if [[ -d $BUILD_DIR ]]; then
  echo "Cleaning up build directory."
  rm -rf $BUILD_DIR
fi

# Clone repo and switch to the right branch
echo "Cloning Repo..."
mkdir -p build
cd build
git clone $REPO_URL .

# Setup deploy vars based on env
ssh_url=""
if [[ $deploy_env == "staging" ]]; then
  ssh_url="${STAGING_ENV}:sites/imshstaging/wp-content/zinnfinity"

  echo "Starting up build to staging server at $ssh_url"
  echo "Switching to branch staging"
  git fetch origin staging
  git checkout staging
elif [[ $deploy_env == "prod" ]]; then
  ssh_url="${PROD_ENV}:sites/imsproduction/wp-content/zinnfinity"

  echo "Starting up build to production server at $ssh_url"
  echo "Switching to branch master"
  git checkout master
else
  echo "Environment not found"
  exit 1
fi

# Locate NVM and set current version
echo "Setting node version"
export NVM_DIR=$HOME/.nvm
source $NVM_DIR/nvm.sh
nvm use

# Install node packages
echo "Installing Node modules"
yarn install --silent
echo "Building site for deploy"
yarn build
rm -rf node_modules

# Deploy to server
read -p "Proceed with deploy? (y/n)" proceed

if [[ $proceed == 'y' ]]; then
  echo "Deploying to $ssh_url"
  rsync -a --verbose --exclude 'node_modules' --exclude=".*" . $ssh_url

  # Cleaning up post deploy
  echo "Deploy complete, cleaning up..."
else
  echo "Abandoning deploy and cleaning up"
fi

cd ..
rm -rf build
