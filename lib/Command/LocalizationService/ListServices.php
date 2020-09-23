<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\LocalizationService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class ListServices extends Command {

	/** @var LocalizationServiceFactory */
	private $ls_factory;

	public function __construct(LocalizationServiceFactory $ls_factory) {
		parent::__construct();
		$this->ls_factory = $ls_factory;
	}

	protected function configure(): void {
		$this->setName('geoblocker:localization-service:list-services')->setDescription(
				'List the IDs of the localization services.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): void {
		$info_string = "<info>\n";
		$i = 0;
		foreach ($this->ls_factory->getLocationServiceOverview() as $key => $value) {
			$info_string .= strval($i). ": ";
			$info_string .= $key;
			if ($value) {
				$info_string .= " [Active]";
			}
			$info_string .= "\n";
			++$i;			
		}
		$info_string .= "</info>";
		$output->writeln($info_string);
		return;
	}
}