#!/bin/bash
#cat cl_start.txt | awk 'NF > 0' | awk -F '\t' 'BEGIN{print "<?php\n/** @var $l \\OCP\\IL10N */\n/** @var $_ array */\n?>\n\n<select name=\"choose-countries\" size=\"10\" multiple class=\"select2-choices\" id=\"choose-countries\">"} {print "\t<option value=\""$1"\" label=\""$2"\" <?php if (strpos ( $_[\x27""countryList\x27], \x27"$1"\x27 ) !== FALSE) print_unescaped(\x27selected=\"selected\"\x27)?>><?php p($l->t(\""$1": "$2"\"))?></option>";} END {print "</select>"}' > "../templates/countries.php"
cat cl_start.txt | awk 'NF > 0' | awk -F '\t' 'BEGIN{print "<?php\n/** @var $l \\OCP\\IL10N */\n/** @var $_ array */\n?>\n\n<select name=\"choose-countries\" size=\"10\" multiple id=\"choose-countries\">"} {print "\t<option value=\""$1"\" <?php if (strpos ( $_[\x27""countryList\x27], \x27"$1"\x27 ) !== FALSE) print_unescaped(\x27selected=\"selected\"\x27)?>><?php p($l->t(\""$1": "$2"\"))?></option>";} END {print "</select>"}' > "../templates/countries.php"

	
