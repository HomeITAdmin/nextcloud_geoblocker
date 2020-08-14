# Nextcloud Geoblocker App

[![GitHub release (latest by date)](https://img.shields.io/github/v/release/homeitadmin/nextcloud_geoblocker)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub Releases](https://img.shields.io/github/downloads/homeitadmin/nextcloud_geoblocker/latest/total)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub All Releases](https://img.shields.io/github/downloads/homeitadmin/nextcloud_geoblocker/total)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub](https://img.shields.io/github/license/homeitadmin/nextcloud_geoblocker)](https://github.com/HomeITAdmin/nextcloud_geoblocker/blob/master/COPYING)
![CI](https://github.com/HomeITAdmin/nextcloud_geoblocker/workflows/CI/badge.svg?branch=master)

This is a server side app for a [nextcloud](https://nextcloud.com/) instance.
This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries.
Login attempts from local network IP addresses are not blocked (or logged).
Wrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.
Determination of the country from IP address is only as good as the chosen service.

You can activate the latest release version of the app in the "Apps" configuration section of your Nextcloud server when logged in as administrator.

## General hints for installation

As for other blocking apps like brute force protection it is important, that the actual IP address from the client is reaching the app and not the address from something inbetween.

One commone source of problems are reverse proxys. Make sure that it is correctly configured to forward the clients IP address as header. You may have to add "trusted_proxies" and "forwarded_for_headers" setting to your Nextcloud config.

A second source of problems are container environments like Docker. Here also the right configuration for these config variables should help. It can make the configuration easier, if you make sure that the containers always have the same internal IP addresses.

## How to activate the location services

There are serveral location services available. The app is only the frontend for the location service, so the services need to be installed by the administrator correctly, that the app can work correctly.

### Geoiplookup

Using the geoiolookip programm available on some linux distributions:

#### Precondition

- PHP must be allowed to use the exec() method. This is configured in the php.ini.

#### Installation

- The geoiplookup and geoiplookup6 commands must be installed on the nextloud host.
  - On Debian based systems: sudo apt-get install geoip-bin geoip-database
  
#### Advantages

- The lookup of the IP address is local, so probably faster and no external service get the information which IPs are loggin into the nextcloud instance.

#### Disadvantages

- Precondition must be fullfilled.
- Installation efforts needed from the administrator.

### MaxMind GeoLite2

Using the MaxMind GeoLite2 PHP API:

- Precondition
  - Free API key needed for MaxMind GeoLite2 from https://www.maxmind.com/en/geolite2/signup.
- Installation
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

- API key needed.
- Installation efforts needed from the administrator.

### Data from Regional Internet Registries (RIRs) (Beta)

Using the information from the Regional Internet Registries (RIRs):

#### Precondition

- PHP configuration "allow_url_fopen" must be true during the update process to download the information from the RIRs. This is configured in the php.ini.
- Internet connection is needed during the update process to download the information from the RIRs.
- PHP GMP (GNU Multiple Precision) extension must be installed and activated all the time. It is needed for the update process and to assign IPs to countries during login. Have a look [here](https://www.php.net/manual/en/book.gmp.php).

#### Installation

- No installastion outside from Nextcloud is needed on the host. 
- When the update is started in the settings section, the data which country got which IP address ranges is downloaded from the RIRs FTP servers.

#### Advantages

- The lookup of the IP address is local, so probably faster and no external service get the information which IPs are loging into the nextcloud instance.
- No installation needed.

#### Disadvantages

- Preconditions need to be fulfilled.
- Currently not functional during update.

## Fail2ban

Until the blocking feature is implemented you can achive some blocking by using fail2ban, relying on the logging feature. Make sure that at least the IP address is included in the logging and the logging time is correct. The following parameters should help to create the filter for fail2ban in English: 

```
datepattern = %%Y-%%m-%%dT%%H:%%M:%%S
failregex = ^.*The user .+ logged in with IP address \\"<HOST>.+  from blocked country .+$
```

Defining the jail is then straight forward. For "maxretry" only 1 makes sense to be as close to a blocking of the login as possible. But the first request is maybe not blocked still.

## Personal remark

Besides the hopefully helpful functionality of the app, it is a learning project for Open Source, Nextcloud App API, PHP, Javascript, HTML, CSS, Clean Coding and Github for me. All kind of feedback, constructive crtiticism and contributions are highly welcome. 
