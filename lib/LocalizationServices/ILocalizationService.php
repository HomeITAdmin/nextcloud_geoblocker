<?php
namespace OCA\GeoBlocker\LocalizationServices;


interface ILocalizationService {
	/**
	 * returns TRUE, if IP Localization with this service is properly working, otherwise FALSE
	 *
	 * @return bool
	 */
	public function getStatus();
	
	/**
	 * If service is not working, returns a string with a hint, what might be the Problem starting with "ERROR: "
	 * If the service is working properly, returns a string starting with "OK". It may give some additional inforamtion after that.
	 *
	 * @return string
	 */
	public function getStatusString();
	
	/**
	 * Returns the country code as string of two charactersof the IP adresses, if it can be determind.
	 * If it is not found, it returns "AA" (Country Code for Country not found).
	 * If the service is not usable, it returns "INVALID"
	 *
	 * @param string $IPAdress The IP Adress to check.
	 * @return string 
	 */
	public function getCountryCodeFromIP(string $IPAddress);
	
}