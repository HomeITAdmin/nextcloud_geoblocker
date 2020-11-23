<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\LocalizationService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class ResetCountries extends Command {

	/** @var GeoBlockerConfig */
	private $config;

	public function __construct(GeoBlockerConfig $config) {
		parent::__construct();
		$this->config = $config;
	}

	protected function configure(): void {
		$this->setName('geoblocker:country-selection:reset')->setDescription(
			'Resets the country selection, so that no country is blocked.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): void {
		$this->config->setUseWhiteListing(false);
		$this->config->setChoosenCountriesByString('');
		return;
	}
}
