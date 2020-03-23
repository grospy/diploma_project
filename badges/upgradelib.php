<?php
//

/**
 * Contains upgrade and install functions for badges.
 *
 * @package    core_badges
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Called on install or upgrade to create default list of backpacks a user can connect to.
 * Don't use the global defines from badgeslib because this is for install/upgrade.
 *
 * @return void
 */
function badges_install_default_backpacks() {
    global $DB;

    $record = new stdClass();
    $record->backpackweburl = 'https://backpack.openbadges.org';
    $record->backpackapiurl = 'https://backpack.openbadges.org';
    $record->apiversion = 1;
    $record->sortorder = 0;
    $record->password = '';

    if (!($bp = $DB->get_record('badge_external_backpack', array('backpackapiurl' => $record->backpackapiurl)))) {
        $bpid = $DB->insert_record('badge_external_backpack', $record);
    } else {
        $bpid = $bp->id;
    }
    set_config('badges_site_backpack', $bpid);

    // All existing backpacks default to V1.
    $DB->set_field('badge_backpack', 'externalbackpackid', $bpid);

    $record = new stdClass();
    $record->backpackapiurl = 'https://api.badgr.io/v2';
    $record->backpackweburl = 'https://badgr.io';
    $record->apiversion = 2;
    $record->sortorder = 1;
    $record->password = '';

    if (!$DB->record_exists('badge_external_backpack', array('backpackapiurl' => $record->backpackapiurl))) {
        $DB->insert_record('badge_external_backpack', $record);
    }

}

