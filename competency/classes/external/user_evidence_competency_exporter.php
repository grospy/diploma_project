<?php
//

/**
 * User evidence competency exporter.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

/**
 * User evidence competency exporter class.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_evidence_competency_exporter extends \core\external\persistent_exporter {

    protected static function define_class() {
        return \core_competency\user_evidence_competency::class;
    }

}
