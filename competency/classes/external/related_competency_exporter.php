<?php
//

/**
 * Class for exporting plan data.
 *
 * @package    core_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

/**
 * Class for exporting related competency data.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class related_competency_exporter extends \core\external\persistent_exporter {

    protected static function define_class() {
        return \core_competency\related_competency::class;
    }
}
