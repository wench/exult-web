#!/bin/sh

echo "Updating from Git..."
git fetch --depth 1 origin master && git checkout FETCH_HEAD

echo "Fixing permissions"
chgrp -R exult .
chmod -f -R a+r .

