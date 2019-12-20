<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface ILocalizationService {
	/**
	 * returns TRUE, if IP Localization with this service is properly working, otherwise FALSE
	 *
	 * @return bool
	 */
	public function getStatus(): bool;

	/**
	 * If service is not working, returns a string with a hint, what might be the Problem starting with "ERROR: "
	 * If the service is working properly, returns a string starting with "OK".
	 * It may give some additional inforamtion after that.
	 *
	 * @return string
	 */
	public function getStatusString(): string;

	/**
	 * Returns the country code of the IP adresses as string of two characters, if it can be determind.
	 * If the country is not found, it returns "AA" (Country Code for Country not found).
	 * If the input wasn't a valid IP Adress it returns "INVALID_IP
	 * If the service is not usable, it returns "UNAVAILABLE"
	 *
	 * @param string $IPAdress
	 *        	The IP Adress to check.
	 * @return string
	 */
	public function getCountryCodeFromIP(string $IPAddress): string;
}