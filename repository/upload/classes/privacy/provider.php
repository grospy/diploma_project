<?php
//

/**
 * Privacy Subsystem implementation for repository_upload.
 *
 * @package    repository_upload
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace repository_upload\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for repository_upload implementing null_provider.
 *
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
