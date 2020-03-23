<?php
//

/**
 * Tour.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tool_usertours\helper;

/**
 * Manage inplace editable saves.
 *
 * @param   string      $itemtype       The type of item.
 * @param   int         $itemid         The ID of the item.
 * @param   mixed       $newvalue       The new value
 * @return  string
 */
function tool_usertours_inplace_editable($itemtype, $itemid, $newvalue) {
    $context = \context_system::instance();
    external_api::validate_context($context);
    require_capability('tool/usertours:managetours', $context);

    if ($itemtype === 'tourname') {
        $tour = helper::get_tour($itemid);
        $tour->set_name($newvalue)->persist();

        return helper::render_tourname_inplace_editable($tour);
    } else if ($itemtype === 'tourdescription') {
        $tour = helper::get_tour($itemid);
        $tour->set_description($newvalue)->persist();

        return helper::render_tourdescription_inplace_editable($tour);
    } else if ($itemtype === 'tourenabled') {
        $tour = helper::get_tour($itemid);
        $tour->set_enabled(!!$newvalue)->persist();
        return helper::render_tourenabled_inplace_editable($tour);
    } else if ($itemtype === 'stepname') {
        $step = helper::get_step($itemid);
        $step->set_title($newvalue)->persist();

        return helper::render_stepname_inplace_editable($step);
    }
}

/**
 * Extend the user navigation to bootstrap tours.
 */
function tool_usertours_extend_navigation_user() {
    \tool_usertours\helper::bootstrap();
}

/**
 * Add JS to bootstrap tours. Only in Moodle 3.3+
 */
function tool_usertours_before_footer() {
    \tool_usertours\helper::bootstrap();
}

/**
 * Map icons for font-awesome themes.
 */
function tool_usertours_get_fontawesome_icon_map() {
    return [
        'tool_usertours:t/export' => 'fa-download',
        'tool_usertours:i/reload' => 'fa-refresh',
        'tool_usertours:t/filler' => 'fa-spacer',
    ];
}
