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

$string['cannotcreatedboninstall'] = '<p>Ne mogu stvoriti bazu podataka.</p>
<p>Navedena baza podataka ne postoji i korisnik nema prava stvaranja baze podataka.</p>
<p>Administrator treba provjeriti postavke baze podataka.</p>';
$string['cannotcreatelangdir'] = 'Nije moguće stvoriti lang mapu';
$string['cannotcreatetempdir'] = 'Nije moguće stvoriti privremenu (TEMP) mapu';
$string['cannotdownloadcomponents'] = 'Nije moguće preuzimanje komponenti';
$string['cannotdownloadzipfile'] = 'Nije moguće preuzeti ZIP datoteku';
$string['cannotfindcomponent'] = 'Nije moguće pronaći komponentu';
$string['cannotsavemd5file'] = 'Nije moguće pohraniti md5 datoteku';
$string['cannotsavezipfile'] = 'Nije moguće pohraniti ZIP datoteku';
$string['cannotunzipfile'] = 'Nije moguće otpakirati datoteku';
$string['componentisuptodate'] = 'Komponenta je dostupna u svojoj najnovijoj inačici.';
$string['dmlexceptiononinstall'] = '<p>Dogodila se pogreška baze podataka [{$a->errorcode}].<br />{$a->debuginfo}';
$string['downloadedfilecheckfailed'] = 'Došlo je do pogreške pri provjeri preuzete datoteke';
$string['invalidmd5'] = 'Neispravna md5 datoteka';
$string['missingrequiredfield'] = 'Nedostaje neko obvezatno polje';
$string['remotedownloaderror'] = 'Nije uspjelo preuzimanje komponente na poslužitelj, provjerite postavke proxyja. Preporuča se uporaba PHP cURL dodatka.<br /><br />Ručno preuzmite datoteku s <a href="{$a->url}">{$a->url}</a> iskopirajte ju u "{$a->dest}" na poslužitelju i raspakirajte.';
$string['wrongdestpath'] = 'Pogrešna odredišna putanja.';
$string['wrongsourcebase'] = 'Pogrešna baza izvornog URL-a';
$string['wrongzipfilename'] = 'Pogrešno ime ZIP datoteke';
