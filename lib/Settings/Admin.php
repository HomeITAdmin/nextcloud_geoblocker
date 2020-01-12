<?php

namespace OCA\GeoBlocker\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;
use OCP\IRequest;

class Admin implements ISettings {
	/** @var GeoBlockerConfig */
	private $config;
	/** @var ILogger */
	private $logger;
	/** @var IRequest */
	private $request;
	public function __construct(GeoBlockerConfig $config, ILogger $logger,
			IRequest $request) {
		$this->config = $config;
		$this->logger = $logger;
		$this->request = $request;
	}
	public function getForm() {
		$response = new TemplateResponse ( 'geoblocker', 'admin' );
		$response->setParams ( 
				[ 'logWithIpAddress' => $this->config->getLogWithIpAddress (),
						'logWithCountryCode' => $this->config->getLogWithCountryCode (),
						'logWithUserName' => $this->config->getLogWithUserName (),
						'countryList' => $this->config->getChoosenCountriesByString (),
						'chosenBlackWhiteList' => $this->config->getUseWhiteListing (),
						'ipAddress' => $this->request->getRemoteAddress()
				] );
		return $response;
	}
	public function getSection() {
		return 'geoblocker';
	}
	public function getPriority() {
		return 10;
	}
}
