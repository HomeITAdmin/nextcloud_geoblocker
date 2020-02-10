<?php
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper;

/** @var $l \OCP\IL10N */
/** @var $_ array */
script ( 'geoblocker', 'admin' );
style ( 'geoblocker', 'admin' );
?>
<div id="geoblocker" class="section">
	<h2><?php p($l->t('GeoBlocker')); ?></h2>
	<?php p($l->t('This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. ')); ?> <br />
	<?php p($l->t('Login attempts from local network IP addresses are not blocked (or logged).')); ?> <br />
	<?php p($l->t('Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address.')); ?> <br />
	<?php p($l->t('If you are accessing from external network, this should be an external IP address: ')); print_unescaped($_['ipAddress'])  ?> <br />
	<?php p($l->t('Determination of the country from IP address is only as good as the chosen service.')); ?> 
	<div id="service">
		<h3><?php p($l->t('Service')); ?></h3>
			<?php p($l->t('Choose the service you want to use to determine the country from the IP Address:')); ?> 
			<br /> <label> <select name="choose-service">
				<option selected="selected">Geoiplookup (<?php p($l->t('local'))?>, <?php p($l->t('default'))?>)</option>
		</select></label> <br /> <?php p($l->t('Status of the chosen service: ')); ?>
			<?php
			// TODO: Make dynamic when there is more then one service.
			$service = new GeoIPLookup ( new GeoIPLookupCmdWrapper () , $l);
			p ( $l->t ( $service->getStatusString () ) );
			?>
	</div>
	<div id="countrySelection">
		<h3><?php p($l->t('Country Selection')); ?></h3>
		<p><?php p($l->t('Selection mode'))?>:
		<select name="choose-white-black-list" id="choose-white-black-list">
				<option value="0"
					<?php if (!$_['chosenBlackWhiteList']) print_unescaped('selected="selected"'); ?>><?php p($l->t('No country is chosen but the selected ones'))?></option>
				<option value="1"
					<?php if ($_['chosenBlackWhiteList']) print_unescaped('selected="selected"'); ?>><?php p($l->t('All countries are chosen but the selected ones'))?></option>
			</select>
		</p>
		<div class="select2-container-multi">
				<?php include 'countries.php';?>
			</div>
		<p>
			<?php p($l->t('The following countries were chosen: '));?> 
		</p>
		<p id="countryList">
			<?php p($_['countryList']) ?>
		</p>
	</div>
	<div id="reaction">
		<h3><?php p($l->t('Reaction')); ?></h3>
		
			<?php p($l->t('If a login attempt is detected from the blacklisted or not whitelisted countries, the attempt is logged with the following information (be aware of data protection issues)'))?>:<br />
		<p id="logWithIpAddress">
			<input type="checkbox" name="log-with-ip-address" id="log-with-ip-address"
				class="checkbox"
				<?php if ($_['logWithIpAddress']) print_unescaped('checked="checked"'); ?>>
			<!-- value="1" -->
			<label for="log-with-ip-address">
					<?php p($l->t('with IP Address'))?></label>
		</p>
		<p id="logWithCountryCode">
			<input type="checkbox" name="log-with-country-code"
				id="log-with-country-code" class="checkbox"
				<?php if ($_['logWithCountryCode']) print_unescaped('checked="checked"'); ?>>
			<label for="log-with-country-code">
					<?php p($l->t('with Country Code'))?></label>
		</p>
		<p id="logWithUserName">
			<input type="checkbox" name="log-with-user-name" id="log-with-user-name"
				class="checkbox"
				<?php if ($_['logWithUserName']) print_unescaped('checked="checked"'); ?>> <label
				for="log-with-user-name">
					<?php p($l->t('with username'))?></label>
		</p>
		<br />
			<?php p($l->t('In addition, the login attempt can also be blocked'))?> <?php p($l->t('(in a future version)'))?>:<br />
		<p>
			<input type="checkbox" name="blocking-active" id="blocking-active"
				class="checkbox" value="1" disabled><label for="blocking-active"><?php p($l->t('Activate blocking of the login attempt from IPs of the specified countries.'))?></label><br />
		</p>
	</div>
</div>
