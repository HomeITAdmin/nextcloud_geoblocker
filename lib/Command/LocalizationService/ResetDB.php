<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\LocalizationService;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCA\GeoBlocker\LocalizationServices\LocationServiceUpdateStatus;

class ResetDB extends Command {

	/** @var LocalizationServiceFactory */
	private $ls_factory;
	/** @var OutputInterface */
	private $output;
	/** @var LoggerInterface */
	private $logger;

	public function __construct(LocalizationServiceFactory $ls_factory, LoggerInterface $logger) {
		parent::__construct();
		$this->ls_factory = $ls_factory;
		$this->logger = $logger;
	}

	protected function configure(): void {
		$this->setName('geoblocker:localization-service:reset-db')->setDescription(
				'Reset the database for the given localization service.')->addArgument(
				'service_id', InputArgument::OPTIONAL,
				'The ID of the localization service, whose database will be reset. If not given the current service will be used.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$this->output = $output;
		if ($input->getArgument('service_id') == null) {
			$service_id = $this->ls_factory->getCurrentLocationServiceID();
		} else {
			$service_id = intval($input->getArgument('service_id'));
		}

		if (! $this->ls_factory->hasDatabaseUpdateByID($service_id)) {
			$this->logError('The database of this service cannot be reset.');
		} else {
			$this->logInfo('Starting reset of the database.');			
			$loc_service = $this->ls_factory->getLocationServiceByID($service_id);
			if ($loc_service->resetDatabase()) {
				if ($loc_service->getDatabaseUpdateStatus() ==
						LocationServiceUpdateStatus::kUpdatePossible &&
						! $loc_service->getStatus()) {
					$this->logInfo('Reset was successful.');
				} else {
					$this->logError('There was a problem when reseting the database. Service is not in correct status.');
				}
			} else {
				$this->logError('There was a problem when reseting the database. Reset function returned false.');
			}
		}

		return 0;
	}

	private function logInfo(string $info) {
		$this->output->writeln('<info>' . $info . '</info>');
		$this->logger->info($info, ['app' => 'geoblocker']);
	}

	private function logError(string $error) {
		$this->output->writeln('<error>ERROR: ' . $error . '</error>');
		$this->logger->error($error, ['app' => 'geoblocker']);
	}
}
