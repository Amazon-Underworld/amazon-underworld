#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
CDIR=$( pwd )
cd $DIR/../themes/amazon-underworld
docker run -it -v `pwd`:/compilar node:20 bash -c "cd compilar && npm install && npm run production"
docker run -it -v `pwd`:/compilar node:20 bash -c "cd /compilar/themes/amazon-underworld/library/blocks/v2 && npm install && npm run build"