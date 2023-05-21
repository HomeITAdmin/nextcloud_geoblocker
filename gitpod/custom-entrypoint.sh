#!/bin/sh 
  
chown www-data:www-data /var/www/html/custom_apps/ 

sudo -u#33 php occ app:enable geoblocker  
  
/entrypoint.sh "$@"