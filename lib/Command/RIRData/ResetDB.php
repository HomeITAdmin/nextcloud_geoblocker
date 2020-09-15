<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Command\RIRData;

use OC\Core\Command\Base;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResetDB extends Command {
	
// 	/** @var CommandService */
// 	private $service;
	
// 	public function __construct(CommandService $service) {
// 		parent::__construct();
// 		$this->service = $service;
// 	}
	
	protected function configure(): void {
		$this
		->setName('geoblocker:rir-data:reset-db')
		->setDescription('Reset the Database for the RIRData Service.');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output): int {
		$output->writeln('<error>Not implemented yet. Code must go here...</error>');
		return 0;
	}
}