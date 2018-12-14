#!/bin/bash

if [! -f master.zip ]; then
    echo "master.zip not found; perhaps you forgot to scp it?"
    exit 1
fi

unzip -fo master.zip
rm -f master.zip
chgrp -R exult htdocs/
chmod -f -R a+r htdocs/
cp htdocs/update.sh ./
