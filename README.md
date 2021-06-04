# Nextcloud Geoblocker App

[![GitHub release (latest by date)](https://img.shields.io/github/v/release/homeitadmin/nextcloud_geoblocker)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub Releases](https://img.shields.io/github/downloads/homeitadmin/nextcloud_geoblocker/latest/total)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub All Releases](https://img.shields.io/github/downloads/homeitadmin/nextcloud_geoblocker/total)](https://github.com/HomeITAdmin/nextcloud_geoblocker/releases)
[![GitHub](https://img.shields.io/github/license/homeitadmin/nextcloud_geoblocker)](https://github.com/HomeITAdmin/nextcloud_geoblocker/blob/master/COPYING)

This is a server side app for a [Nextcloud](https://nextcloud.com/) instance.
This is a front end to geo localization services, that allows blocking (beta),
delaying (beta) and logging of login attempts from specified countries.
Login attempts from local network IP addresses are never blocked, delayed or logged.
In the current implementation the login page is normally shown to everybody independend
of the country. Also login attempts with a non existing user are failing as usual
independend of the country.
Wrong Nextcloud configuration (especially in container) can lead to all access
seems to come from local network IP address.
Determination of the country from IP address is only as good as the chosen service.

You can activate the latest release version of the app in the "Apps" configuration
section of your Nextcloud server when logged in as administrator.

## General hints for installation

As for other blocking apps like brute force protection it is important, that the
actual IP address from the client is reaching the app and not the address from
something inbetween.

One commone source of problems are reverse proxys. Make sure that it is correctly
configured to forward the clients IP address as header. You may have to add
"trusted_proxies" and "forwarded_for_headers" setting to your Nextcloud config.

A second source of problems are container environments like Docker. Here also the
right configuration for these config variables should help. It can make the
configuration easier, if you make sure that the containers always have the same
internal IP addresses.

### I cannot login anymore

If you cannot login anymore because Geoblocker App here are some hints what to do:

- Geoblocker is causing an exception during the login:
  - Option 1: Deactivate the Geoblocker App over the command line
    - `sudo -u %NEXTCLOUD_INSTANCE_USER% php occ app:disable geoblocker`
  - Option 2: From version 0.4.5 on you can switch to the dummy service and reset
    the country list on the command line:
    - `sudo -u %NEXTCLOUD_INSTANCE_USER% php occ
      geoblocker:localization-service:select-service 3`
    - `sudo -u %NEXTCLOUD_INSTANCE_USER% php occ geoblocker:country-selection:reset`
- You accidently blocked the country you are in:
  - Option 1: Login from an internal network.
  - Option 2: Form version 0.4.5 on you can reset the country list on the command
    line:
    - `sudo -u %NEXTCLOUD_INSTANCE_USER% php occ geoblocker:country-selection:reset`

## How to activate the location services

There are serveral location services available. The app is only the frontend for
the location service, so the services need to be installed by the administrator
correctly, that the app can work correctly.

### Dummy

This is just a dummy location service always returning "Country not found"
for debug purposes.

### Geoiplookup

Using the geoiplookup programm available on some linux distributions:

- Precondition
  - PHP must be allowed to use the exec() method. This is configured in the
  php.ini.
- Installation
  - The geoiplookup and geoiplookup6 commands must be installed on the nextloud
  host.
    - On Debian based systems: sudo apt-get install geoip-bin geoip-database
- Advantages
  - The lookup of the IP address is local, so probably faster and no external
  service get the information which IPs are loggin into the nextcloud instance.
- Disadvantages
  - Precondition must be fullfilled.
  - Installation efforts needed from the administrator.

### MaxMind GeoLite2

Using the MaxMind GeoLite2 PHP API:

- Precondition
  - Free API key needed for
  [MaxMind GeoLite2](https://www.maxmind.com/en/geolite2/signup).
- Installation
  - Download the file "geoip2.phar" to the folder "3rdparty/maxmind_geolite2/"
  inside the GeoBlocker app folder (the folder already exists under
  "$NEXTCLOUD_ROOT$/$CUSTOM_APP_FOLDER$/geoblocker/3rdparty/maxmind_geolite2/")
  from the MaxMind GeoIP2
  [release page](https://github.com/maxmind/GeoIP2-php/releases).
  Alternatively you can put the file in the same folder as the database mentioned
  below (from version 0.4.5 on).
  - Download the latest country database E.g.:
    - On Debian based systems the database gets downloaded to
    "/var/lib/GeoIP/GeoLite2-Country.mmdb" by:
      - `sudo apt-get install geoipupdate`
      - For this the "contrib" archiv must be activ.
      - Add the API key information to "/etc/GeoIP.conf"
      - run `sudo geoipupdate`
  - Make sure you have the right database path configured in the Geoblocker Settings
  page.
  - For Docker user: See
  [#20](https://github.com/HomeITAdmin/nextcloud_geoblocker/issues/20)
  how to use a seperate container to do the update of the database.
- Advantages
  - The lookup of the IP address is local, so probably faster and no external
  service get the information which IPs are loggin into the nextcloud instance.
- Disadvantages
  - API key needed.
  - Installation efforts needed from the administrator.

If Geoblocker is insisting on that there is an error in the installation the following
my help:

- Open a shell and go to the folder of the geoip2.phar.
- Start an interactive php shell:
  - `sudo -u www-data php -a`
- Run this line of code (replacing the db path for your system, and run it as one
  line in the shell):

```php
include 'geoip2.phar'; use GeoIp2\Database\Reader; $reader = new Reader('%ABSOLUT_PATH_TO_DB%'); print($reader->country('24.165.23.67')->country->isoCode);
```

- This should either give you "US" as output or an hopefully helpful error message.

### Data from Regional Internet Registries (RIRs)

Using the information from the Regional Internet Registries (RIRs):

- Precondition
  - PHP configuration "allow_url_fopen" must be true during the update process to
  download the information from the RIRs. This is configured in the php.ini.
  - Internet connection is needed during the update process to download the
  information from the RIRs.
  - PHP GMP (GNU Multiple Precision) extension must be installed and activated all
  the time. It is needed for the update process and to assign IPs to countries
  during login. Have a look in the
  [PHP manual](https://www.php.net/manual/en/book.gmp.php).
- Installation
  - No installastion outside from Nextcloud is needed on the host.
  - When the update is started in the settings section, the data which country got
  which IP address ranges is downloaded from the RIRs FTP servers.
- Advantages
  - The lookup of the IP address is local, so probably faster and no external
  service get the information which IPs are loging into the nextcloud instance.
  - No installation needed.
- Disadvantages
  - Preconditions need to be fulfilled.
  - Currently not functional during update. (Will be solved in 0.4.5)
- Known issues
  - If the nextcloud instance is restarted during the update of the service, the
  service stays in the update process forever. At the moment you have to use the
  command line to reset the database of the service and get the service back into
  a valid state:
    - `sudo -u %NEXTCLOUD_INSTANCE_USER% php occ
    geoblocker:localization-service:reset-db 2`
  - IPv6 needs at least a 64 bit system to work correctly.

## Fail2ban

Alternatively to the blocking in the app, you can achive some blocking by using
fail2ban, relying on the logging feature. Make sure that at least the IP address
is included in the logging and the logging time is correct. The following
parameters should help to create the filter for fail2ban in English:

```cfg
datepattern = %%Y-%%m-%%dT%%H:%%M:%%S
failregex = ^.*The user .+ logged in with IP address \\"<HOST>.+  from blocked country .+$
```

Defining the jail is then straight forward. For "maxretry" only 1 makes sense to
be as close to a blocking of the login as possible. But the first request is
maybe not blocked still.

## Personal remark

Besides the hopefully helpful functionality of the app, it is a learning project
for Open Source, Nextcloud App API, PHP, Javascript, HTML, CSS, Clean Coding and
Github for me. All kind of feedback, constructive crtiticism and contributions are
highly welcome.
