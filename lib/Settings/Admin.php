<?php

namespace OCA\GeoBlocker\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;
use OCP\IRequest;
use OCP\IUserSession;
use OCP\IL10N;
use OCP\IDbConnection;
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
	/** @var IDBConnection */
	private $db;
	public function __construct(GeoBlockerConfig $config, ILogger $logger,
			IRequest $request, IUserSession $user_session, IL10N $l, IDbConnection $db) {
		$this->config = $config;
		$this->logger = $logger;
		$this->request = $request;
		$this->user_session = $user_session;
		$this->l = $l;
		$this->db = $db;
	}
	public function getForm() {
		$response = new TemplateResponse('geoblocker', 'admin');
		$localizationServiceFactory = new LocalizationServiceFactory(
				$this->config, $this->l, $this->db);
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
					'delayIpAddress' => $this->config->getDelayIpAddress(),
					'blockIpAddress' => $this->config->getBlockIpAddress(),
					'blockIpAddressBefore' => $this->config->getBlockIpAddressBefore(),
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
