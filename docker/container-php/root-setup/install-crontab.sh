#!/bin/bash

curdir=$(dirname $0)
echo "curdir: $curdir"

cat $curdir/crontab-root-gaia | crontab -

crontab -l

service cron start
