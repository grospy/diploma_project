<?php
//

/**
 * Sets up the tabs used by the scorm pages based on the users capabilities.
 *
 * @author Dan Marsden and others.
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_scorm
 */

if (empty($scorm)) {
    print_error('cannotaccess', 'mod_scorm');
}
if (!isset($currenttab)) {
    $currenttab = '';
}
$tabs = array();
$row = array();
$inactive = array();
$activated = array();

$scoesurl = new moodle_url('/mod/scorm/report/userreport.php', array('id' => $id,
    'user' => $userid,
    'attempt' => $attempt));

$interactionssurl = new moodle_url('/mod/scorm/report/userreportinteractions.php', array('id' => $id,
    'user' => $userid,
    'attempt' => $attempt));
$row[] = new tabobject('scoes', $scoesurl, get_string('scoes', 'scorm'));
$row[] = new tabobject('interactions', $interactionssurl, get_string('interactions', 'scorm'));

$tabs[] = $row;
print_tabs($tabs, $currenttab, $inactive, $activated);
