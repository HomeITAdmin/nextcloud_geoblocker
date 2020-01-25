# Nextcloud Geoblocker App
This is a server side app for a nextcloud instance (https://nextcloud.com/).
This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries.
Login attempts from local network IP addresses are not blocked (or logged).
Wrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.
Determination of the country from IP address is only as good as the chosen service. 

You can activate the latest release version of the app in the "Apps" configuration section of your Nextcloud server when logged in as admin.

## Personal remark
Besides the hopefully helpful functionality of the app, it is a learning project for Open Source, Nextcloud App API, PHP, Javascript, HTML, CSS, Clean Coding and Github for me. All kind of feedback, constructive crtiticism and contributions are highly welcome. 
