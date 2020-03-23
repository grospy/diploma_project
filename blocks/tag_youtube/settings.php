<?php
//

/**
 * Settings for the RSS client block.
 *
 * @package   block_tag_youtube
 * @copyright 2015 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('block_tag_youtube/apikey', get_string('apikey', 'block_tag_youtube'),
                       get_string('apikeyinfo', 'block_tag_youtube'), '', PARAM_RAW_TRIMMED, 40));
}
