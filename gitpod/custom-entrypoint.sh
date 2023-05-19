#!/bin/sh 
  
 chown www-data:www-data /var/www/html/custom_apps/ 
  
 /entrypoint.sh "$@"