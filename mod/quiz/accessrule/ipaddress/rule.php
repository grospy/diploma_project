<?php
//

/**
 * Implementaton of the quizaccess_ipaddress plugin.
 *
 * @package    quizaccess
 * @subpackage ipaddress
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/accessrule/accessrulebase.php');


/**
 * A rule implementing the ipaddress check against the ->subnet setting.
 *
 * @copyright  2009 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_ipaddress extends quiz_access_rule_base {

    public static function make(quiz $quizobj, $timenow, $canignoretimelimits) {
        if (empty($quizobj->get_quiz()->subnet)) {
            return null;
        }

        return new self($quizobj, $timenow);
    }

    public function prevent_access() {
        if (address_in_subnet(getremoteaddr(), $this->quiz->subnet)) {
            return false;
        } else {
            return get_string('subnetwrong', 'quizaccess_ipaddress');
        }
    }
}
