#!/usr/bin/env bash

cnpm init
cnpm i babel-core babel-loader css-loader url-loader style-loader webpack webpack-dev-server autoprefixer-loader less less-loader --save-dev
cnpm i react flux immutable normalize.css --save
mkdir src
cd src
mkdir less && mkdir images && mkdir components && mkdir entry && mkdir constants && mkdir actions && mkdir stores && mkdir dispatcher && mkdir common
cd ..
mkdir test
mkdir dist
cp -f ~/www/myBoilerPlate/reactProject/index.html ./
cp -f ~/www/myBoilerPlate/reactProject/index.dev.html ./test/index.html
cp ~/www/myBoilerPlate/reactProject/.gitignore ./