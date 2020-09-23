<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\LocalizationService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCA\GeoBlocker\LocalizationServices\LocationServiceUpdateStatus;

class ResetDB extends Command {

	/** @var LocalizationServiceFactory */
	private $ls_factory;

	public function __construct(LocalizationServiceFactory $ls_factory) {
		parent::__construct();
		$this->ls_factory = $ls_factory;
	}

	protected function configure(): void {
		$this->setName('geoblocker:localization-service:reset-db')->setDescription(
				'Reset the database for the given localization service.')->addArgument(
				'service_id', InputArgument::REQUIRED,
				'The ID of the localization service, whose database will be reset.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): void {
		$service_id = intval($input->getArgument('service_id'));

		if (! $this->ls_factory->hasDatabaseUpdateByID($service_id)) {
			$output->writeln(
					'<error>The database of this service cannot be reset.</error>');
		} else {
			if ($this->ls_factory->resetDatabaseByID($service_id)) {
				$loc_service = $this->ls_factory->getLocationServiceByID($service_id);
				if ($loc_service->getDatabaseUpdateStatus() !=
						LocationServiceUpdateStatus::kUpdating &&
						! $loc_service->getStatus()) {
					$output->writeln('<info>Reset was successful.</info>');
				} else {
					$output->writeln(
							'<error>There was a problem when reseting the database. Service is not in correct status.</error>');
				}
			} else {
				$output->writeln(
						'<error>There was a problem when reseting the database. Reset function returned false.</error>');
			}
		}

		return;
	}
}