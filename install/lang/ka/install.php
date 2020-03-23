<?php

//

/**
 * Automatically generated strings for Moodle installer
 *
 * Do not edit this file manually! It contains just a subset of strings
 * needed during the very first steps of installation. This file was
 * generated automatically by export-installer.php (which is part of AMOS
 * {@link http://docs.moodle.org/dev/Languages/AMOS}) using the
 * list of strings defined in /install/stringnames.txt.
 *
 * @package   installer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirname'] = 'ადმინისტრატორის დირექტორია';
$string['availablelangs'] = 'ხელმისაწვდომი ენის პაკეტები';
$string['chooselanguagehead'] = 'აირჩიეთ ენა';
$string['dataroot'] = 'მონაცემტა დირექტორია';
$string['dbprefix'] = 'ცხრილების პრეფიქსი';
$string['dirroot'] = 'Moodle-ის დირექტორია';
$string['installation'] = 'ინსტალირება';
$string['memorylimithelp'] = '<p>The PHP memory limit for your server is currently set to {$a}.</p>

<p>This may cause Moodle to have memory problems later on, especially
if you have a lot of modules enabled and/or a lot of users.</p>

<p>We recommend that you configure PHP with a higher limit if possible, like 40M.
There are several ways of doing this that you can try:</p>
<ol>
<li>If you are able to, recompile PHP with <i>--enable-memory-limit</i>.
This will allow Moodle to set the memory limit itself.</li>
<li>If you have access to your php.ini file, you can change the <b>memory_limit</b>
setting in there to something like 40M. If you don\'t have access you might
be able to ask your administrator to do this for you.</li>
<li>On some PHP servers you can create a .htaccess file in the Moodle directory
containing this line:
<p><blockquote>php_value memory_limit 40M</blockquote></p>
<p>However, on some servers this will prevent <b>all</b> PHP pages from working
(you will see errors when you look at pages) so you\'ll have to remove the .htaccess file.</p></li>
</ol>';
$string['phpversion'] = 'PHP ვარიანტი';
$string['phpversionhelp'] = '<p>Moodle requires a PHP version of at least 4.1.0.</p>
<p>You are currently running version {$a}</p>
<p>You must upgrade PHP or move to a host with a newer version of PHP!</p>';
$string['wwwroot'] = 'Web მისამართი';
