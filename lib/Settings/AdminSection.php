<?php

namespace OCA\GeoBlocker\Settings;

use OCP\IL10N;
use OCP\Settings\IIconSection;
use OCP\IURLGenerator;

class AdminSection implements IIconSection {

	/** @var IL10N */
	private $l;
	/** @var IURLGenerator */
	private $url;
	public function __construct(IURLGenerator $url, IL10N $l) {
		$this->l = $l;
		$this->url=$url;
	}
	/**
	 * returns the ID of the section.
	 * It is supposed to be a lower case string
	 *
	 * @returns string
	 */
	public function getID() {
		return 'geoblocker'; // or a generic id if feasible
	}

	/**
	 * returns the translated name as it should be displayed, e.g.
	 * 'LDAP / AD
	 * integration'. Use the L10N service to translate it.
	 *
	 * @return string
	 */
	public function getName() {
		return $this->l->t('GeoBlocker');
	}

	/**
	 *
	 * @return int whether the form should be rather on the top or bottom of
	 *         the settings navigation. The sections are arranged in ascending order of
	 *         the priority values. It is required to return a value between 0 and 99.
	 */
	public function getPriority() {
		return 50;
	}
	
	public function getIcon() {
		return $this->url->imagePath('geoblocker', 'blocking-dark.svg');
	}
}
