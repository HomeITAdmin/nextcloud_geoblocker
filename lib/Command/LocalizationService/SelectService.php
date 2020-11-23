<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\LocalizationService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class SelectService extends Command {

	/** @var LocalizationServiceFactory */
	private $ls_factory;

	public function __construct(LocalizationServiceFactory $ls_factory) {
		parent::__construct();
		$this->ls_factory = $ls_factory;
	}

	protected function configure(): void {
		$this->setName('geoblocker:localization-service:select-service')->setDescription(
				'Select the location service, that is used to determine the country code.')->addArgument(
				'service_id', InputArgument::REQUIRED,
				'The ID of the localization service to be used.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): void {
		$service_id = intval($input->getArgument('service_id'));

		$this->ls_factory->setCurrentLocationServiceID($service_id);

		return;
	}
}
