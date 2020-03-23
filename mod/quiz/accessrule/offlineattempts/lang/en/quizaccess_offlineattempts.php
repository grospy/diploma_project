<?php
//

/**
 * Strings for the quizaccess_offlineattempts plugin.
 *
 * @package    quizaccess_offlineattempts
 * @copyright  2016 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowofflineattempts'] = 'Allow quiz to be attempted offline using the mobile app';
$string['allowofflineattempts_help'] = 'If enabled, a mobile app user can download the quiz and attempt it offline.

Note: It is not possible for a quiz to be attempted offline if it has a time limit, or requires a network address, or uses any question behaviour other than deferred feedback (with or without CBM).';
$string['confirmdatasaved'] = 'I confirm that I do not have any unsaved work on a mobile device.';
$string['mobileapp'] = 'Mobile app';
$string['offlineattemptserror'] = 'It is not possible for a quiz to be attempted offline if it has a time limit, or requires a network address, or uses any question behaviour other than deferred feedback (with or without CBM).';
$string['offlinedatamessage'] = 'You have worked on this attempt using a mobile device. Data was last saved to this site {$a} ago.';
$string['pleaseconfirm'] = 'Please check and confirm that you do not have any unsaved work.';
$string['pluginname'] = 'Offline attempts access rule';
$string['privacy:metadata'] = 'The Offline attempts quiz access rule plugin does not store any personal data.';
