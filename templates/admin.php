<?php
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

/** @var $l \OCP\IL10N */
/** @var $_ array */
script ( 'geoblocker', 'admin' );
style ( 'geoblocker', 'admin' );
$loading = $l->t('Loading').'...';
?>
<div id="geoblocker" class="section">
	<h2><?php p($l->t('GeoBlocker')); ?></h2>
	<div class="subsection">
		<p><?php p($l->t('This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. ')); ?> </p>
		<p><?php p($l->t('Login attempts from local network IP addresses are not blocked (or logged).')); ?> </p>
		<p><?php p($l->t('Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address.')); ?> </p>
		<p><?php p($l->t('If you are accessing from external network, this should be an external IP address: ')); p($_['ipAddress']); p(' '); 
		if (GeoBlocker::isIPAddressLocal($_['ipAddress'])) {
			p($l->t('is local.'));
		} else {
			p($l->t('is external.'));
		} 
			?> </p>
			
		<p><?php p($l->t('Determination of the country from IP address is only as good as the chosen service.')); ?></p> 
		<p><?php p($l->t('For help how to setup the localization services, have a look into the Readme in the ')); ?><a href="https://github.com/HomeITAdmin/nextcloud_geoblocker/"><?php p($l->t('repository')); ?></a>.</p>
	</div>
	
	<h3><?php p($l->t('Service')); ?></h3>
	<div class="subsection">
		<p>
			<?php p($l->t('Choose the service you want to use to determine the country from the IP Address:')); ?> <br />
		</p> 
			<p class="subsection"><label> 
				<select name="choose-service" id="choose-service">
					<?php 
						$service_overview = $_['localizationServiceFactory']->getLocationServiceOverview();
						$value = 0;
						foreach ($service_overview as $service_name => $chosen_service) {
							print_unescaped('<option value="'.$value.'" ');
							if ($chosen_service) print_unescaped('selected="selected" ');
							print_unescaped('>'.$service_name.'</option>');
							$value = $value +1;
						}
					?>
				</select>
			</label> </p> 
		
		<p>
		<?php p($l->t('Status of the chosen service: ')); ?>
		</p>
			<div class="subsection">
				<p  id="status-chosen-service"><?php p($loading); ?></p>		
				<div class="subsection" id="database-date" style="display:none" >
					<?php p($l->t('Date of the database: '));?>						
					<p class="subsection" id="database-date-string" ><?php p($loading); ?></p>		
				</div>	
			</div>
		<div id="service-config" style="display:none">
			<p>
			<?php p($l->t('Configuration of the chosen service: ')); ?>
			</p>			
			<div class="subsection" id="database-path" style="display:none" >
				<?php p($l->t('Location of the database: '));?>						
				<input class="path-input" type="text" size="50" id="database-path-string" value="<?php p($loading); ?>" >		
			</div>			
<!-- 			in work begin -->
			<div class="subsection" id="database-update" style="display:none" >	
				<input class="button-input" type="button" id="database-update-button" value="<?php p($l->t('Update Database')) ?>" disabled>
				<p class="subsection">
					<span id="database-update-string-prefix"><?php p($loading); ?></span> 
					<span id="database-update-string"><?php p($loading); ?></span>
				</p>
			</div>	
<!-- 			in work end -->
		</div>
		
	</div>
	<h3><?php p($l->t('Country Selection')); ?></h3>
	<div class="subsection">
		<p>
			<?php p($l->t('Choose the selection mode'))?>:
		</p>
			<p class="subsection">
				<select name="choose-white-black-list" id="choose-white-black-list">
					<option value="0"
						<?php if (!$_['chosenBlackWhiteList']) print_unescaped('selected="selected"'); ?>><?php p($l->t('No country is blocked but the selected ones (blacklist)'))?></option>
					<option value="1"
						<?php if ($_['chosenBlackWhiteList']) print_unescaped('selected="selected"'); ?>><?php p($l->t('All countries are blocked but the selected ones (whitelist)'))?></option>
				</select> 
			</p>
			
		<p>
			<?php p($l->t('Select countries from list'))?>: <br>
		</p>
			<p class="subsection">
				<?php include 'countries.php';?>
			</p>
		<p>
			<?php p($l->t('The following countries were selected in the list above: '));?>
		</p> 
			<p class="subsection" id="countryList">
				<?php p($_['countryList']) ?>
			</p>
	</div>
	
	
	<h3><?php p($l->t('Reaction')); ?></h3>
	<div class="subsection">
		<p>
			<?php p($l->t('If a login attempt is detected from the chosen countries, the attempt is logged with the following information'));
				p(' ');
				p($l->t('( be aware of data protection issues depending on your logging strategy)'));?>:
		</p>
		
			<p class="subsection">
				<input type="checkbox" name="log-with-ip-address" id="log-with-ip-address"
					class="checkbox"
					<?php if ($_['logWithIpAddress']) print_unescaped('checked="checked"'); ?>>
				<label for="log-with-ip-address">
						<?php p($l->t('with IP Address'))?></label>
			</p>
			<p class="subsection">
				<input type="checkbox" name="log-with-country-code"
					id="log-with-country-code" class="checkbox"
					<?php if ($_['logWithCountryCode']) print_unescaped('checked="checked"'); ?>>
				<label for="log-with-country-code">
						<?php p($l->t('with Country Code'))?></label><br/>
			</p>
			<p class="subsection">	
				<input type="checkbox" name="log-with-user-name" id="log-with-user-name"
					class="checkbox"
					<?php if ($_['logWithUserName']) print_unescaped('checked="checked"'); ?>> <label
					for="log-with-user-name">
						<?php p($l->t('with username'))?></label><br/>
			</p>
		
		<br/>
		<p>
			<?php p($l->t('In addition, the login attempt can also be blocked'))?> <?php p($l->t('(in a future version)'))?>:
		</p>
			<p class="subsection">
				<input type="checkbox" name="blocking-active" id="blocking-active" class="checkbox" value="1" disabled>
					<label for="blocking-active">
						<?php p($l->t('Activate blocking of the login attempt from IP addresses of the specified countries.'))?>
					</label>
			</p>
		
	</div>
	
	<h3><?php p($l->t('Test')); ?></h3>
	<div class="subsection">
		<p>
			<?php p($l->t('Possibilities to test if the Geoblocker is working as expected:'))?>
		</p>
		<p class="subsection">
			<input type="checkbox" name="do-fake-address" id="do-fake-address" class="checkbox"
				<?php if ($_['doFakeAddress']) print_unescaped('checked="checked"'); ?>> 
				<label for="do-fake-address">
					<?php p($l->t('Next login attempt of user "%s" will be simulated to come from the following IP address:',$_['userID']))?>
				</label>
			<input type="text" name="fake-address" id="fake-address" value="<?php print_unescaped($_['fakeAddress'])?>" >
		</p>
	</div>

</div>

