#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
CDIR=$( pwd )
cd $DIR/../themes
rm -f ../zips/amazon-underworld.zip
zip -r ../zips/amazon-underworld.zip amazon-underworld -x "amazon-underworld/node_modules/*"
