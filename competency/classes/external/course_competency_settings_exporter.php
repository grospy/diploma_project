<?php
//

/**
 * Class for exporting course_competency_settings data.
 *
 * @package    core_competency
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

/**
 * Class for exporting course_competency_settings data.
 *
 * @package    core_competency
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_competency_settings_exporter extends \core\external\persistent_exporter {

    protected static function define_class() {
        return \core_competency\course_competency_settings::class;
    }

}
