#!/usr/bin/env sh
sed -i '' -e "s|\"spiral/roadrunner\": \".*\"|\"spiral/roadrunner\": \"$1\"|g" composer.json
sed -i '' -e "s/ENV RR_VERSION .*/ENV RR_VERSION $1/g" ./containers/roadrunner/Dockerfile
git add composer.json ./containers/roadrunner/Dockerfile
git commit -m "update RoadRunner to $1"
