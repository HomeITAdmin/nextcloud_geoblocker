<?php

namespace OCA\GeoBlocker\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;
use OCP\IRequest;
use OCP\IUserSession;
use OCP\IL10N;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class Admin implements ISettings {
	/** @var GeoBlockerConfig */
	private $config;
	/** @var ILogger */
	private $logger;
	/** @var IRequest */
	private $request;
	/** @var IUserSession */
	private $user_session;
	/** @var IL10N */
	private $l;
	public function __construct(GeoBlockerConfig $config, ILogger $logger,
			IRequest $request, IUserSession $user_session, IL10N $l) {
		$this->config = $config;
		$this->logger = $logger;
		$this->request = $request;
		$this->user_session = $user_session;
		$this->l = $l;
	}
	public function getForm() {
		$response = new TemplateResponse('geoblocker', 'admin');
		$localizationServiceFactory = new LocalizationServiceFactory(
				$this->config, $this->l);
		$response->setParams(
				['logWithIpAddress' => $this->config->getLogWithIpAddress(),
					'logWithCountryCode' => $this->config->getLogWithCountryCode(),
					'logWithUserName' => $this->config->getLogWithUserName(),
					'countryList' => $this->config->getChoosenCountriesByString(),
					'chosenBlackWhiteList' => $this->config->getUseWhiteListing(),
					'ipAddress' => $this->request->getRemoteAddress(),
					'doFakeAddress' => $this->config->getDoFakeAddress(),
					'userID' => $this->user_session->getUser()->getUID(),
					'fakeAddress' => $this->config->getFakeAddress(),
					'chosenService' => $this->config->getChosenService(),
					'localizationServiceFactory' => $localizationServiceFactory
				]);
		return $response;
	}
	public function getSection() {
		return 'geoblocker';
	}
	public function getPriority() {
		return 10;
	}
}
