<?php
//

/**
 * Defines classes used for plugin info.
 *
 * @package    core
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

defined('MOODLE_INTERNAL') || die();

/**
 * Class representing an MNet service
 */
class mnetservice extends base {

    public function is_enabled() {
        global $CFG;

        if (empty($CFG->mnet_dispatcher_mode) || $CFG->mnet_dispatcher_mode !== 'strict') {
            return false;
        } else {
            return parent::is_enabled();
        }
    }
}
