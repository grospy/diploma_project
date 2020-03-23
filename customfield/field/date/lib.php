<?php
//

/**
 * Customfield date plugin
 *
 * @package   customfield_date
 * @copyright 2018 Daniel Neis Araujo <daniel@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Get icon mapping for font-awesome.
 */
function customfield_date_get_fontawesome_icon_map() {
    return [
        'customfield_date:checked' => 'fa-check-square-o',
        'customfield_date:notchecked' => 'fa-square-o',
    ];
}
