# Nextcloud Geoblocker App
This is a server side app for a nextcloud instance (https://nextcloud.com/).
This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries.
Login attempts from local network IP addresses are not blocked (or logged).
Wrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.
Determination of the country from IP address is only as good as the chosen service. 

You can activate the latest release version of the app in the "Apps" configuration section of your Nextcloud server when logged in as administrator.

## How to activate the location services
There are serveral location services available. The app is only the frontend for the location service, so the services need to be installed by the administrator correctly, that the app can work correctly.

### Geoiplookup
#### Precondition
- PHP must be allowed to use the exec() method. This is configured in the php.ini.
#### Installation
- The geoiplookup and geoiplookup6 commands must be installed on the nextloud host.
  - On Debian based systems: sudo apt-get install geoip-bin geoip-database
#### Advantages
- The lookup of the IP address is local, so probably faster and no external service get the information which IPs are loggin into the nextcloud instance.
#### Disadvantages
- Precondition must be fullfilled
- Installation efforts needed from the administrator

### MaxMind GeoLite2
#### Precondition
- Free API key needed for MaxMind GeoLite2 from https://www.maxmind.com/en/geolite2/signup.
#### Installation 
- Download the file "geoip2.phar" to the folder "3rdparty/maxmind_geolite2/" inside the GeoBlocker app folder from the MaxMind GeoIP2 [release page](https://github.com/maxmind/GeoIP2-php/releases).
- Download the latest country database to "/usr/share/GeoIP/GeoLite2-Country.mmdb". E.g.:
  - On Debian based systems: sudo apt-get install geoipupdate
    - For this the "contrib" archiv must be activ.
  - Add the API key information to "/etc/GeoIP.conf" 
  - run "sudo geoipupdate"
- For Docker user: See [#20](https://github.com/HomeITAdmin/nextcloud_geoblocker/issues/20) how to use a seperate container to do the update of the database.
#### Advantages
- The lookup of the IP address is local, so probably faster and no external service get the information which IPs are loggin into the nextcloud instance.
#### Disadvantages
- API key needed
- Installation efforts needed from the administrator


## Personal remark
Besides the hopefully helpful functionality of the app, it is a learning project for Open Source, Nextcloud App API, PHP, Javascript, HTML, CSS, Clean Coding and Github for me. All kind of feedback, constructive crtiticism and contributions are highly welcome. 
