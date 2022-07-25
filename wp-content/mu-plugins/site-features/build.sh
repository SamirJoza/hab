#!/usr/bin/env bash

# filename: build.sh
read -p "Have you bumped plugin version?(y/n): " ans
if [ $ans = "y" ]; then
  echo
  echo "Building production bundle..."
  npx mix --production
else
  echo
  echo "Abort! Please update version number in nsp-gravity-form.php"
  echo
fi
