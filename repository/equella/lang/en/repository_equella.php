<?php
//

/**
 * Strings for equella repository.
 *
 * @package   repository_equella
 * @copyright 2012 Dongsheng Cai {@link http://dongsheng.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'EQUELLA repository';
$string['configplugin'] = 'Configuration for EQUELLA repository';
$string['search'] = 'Search EQUELLA';
$string['breadcrumb'] = 'EQUELLA';

$string['equellaurl'] = 'EQUELLA URL';
$string['equellaaction'] = 'EQUELLA action';
$string['equellaoptions'] = 'EQUELLA options';
$string['equella:view'] = 'View EQUELLA repository';
$string['sharedid'] = 'Shared secret ID';
$string['sharedsecrets'] = 'Shared secret';

$string['selectrestriction'] = 'Restrict selection';
$string['selectrestriction.desc'] = 'Choose whether course editors should only be able to select an item summary, an attached resources or either';
$string['restrictionnone'] = 'No restriction';
$string['restrictionitemsonly'] = 'Item summary only';
$string['restrictionattachmentsonly'] = 'Attached resource only';

$string['sharedsecretsheading'] = 'Shared Secret Settings';
$string['sharedsecretshelp'] =  '<p>Below you can set a default EQUELLA shared secret for single signing-on users.  You can configure different shared secrets for general (read) usage, and a specialised role based shared secret for each <em>write</em> role in your Moodle site.  If a shared secret ID is not configured for a role then the default shared secret ID and shared secret are used.</p><p>All shared secret IDs and shared secrets must also be configured within EQUELLA and the shared secret module enabled.  This configuration is found in the EQUELLA Administration Console under User Management > Shared Secrets.</p>';
$string['group'] = '{$a} role settings';
$string['groupdefault'] = 'Default';
$string['sharedidtitle'] = 'Shared secret ID';
$string['sharedsecrettitle'] = 'Shared secret';
$string['privacy:metadata'] = 'The EQUELLA repository plugin does not store any personal data, but does transmit user data from Moodle to the remote system.';
