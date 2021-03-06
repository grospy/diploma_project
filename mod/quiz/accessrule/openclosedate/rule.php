<?php
//

/**
 * Implementaton of the quizaccess_openclosedate plugin.
 *
 * @package    quizaccess
 * @subpackage openclosedate
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/quiz/accessrule/accessrulebase.php');


/**
 * A rule enforcing open and close dates.
 *
 * @copyright  2009 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_openclosedate extends quiz_access_rule_base {

    public static function make(quiz $quizobj, $timenow, $canignoretimelimits) {
        // This rule is always used, even if the quiz has no open or close date.
        return new self($quizobj, $timenow);
    }

    public function description() {
        $result = array();
        if ($this->timenow < $this->quiz->timeopen) {
            $result[] = get_string('quiznotavailable', 'quizaccess_openclosedate',
                    userdate($this->quiz->timeopen));
            if ($this->quiz->timeclose) {
                $result[] = get_string('quizcloseson', 'quiz', userdate($this->quiz->timeclose));
            }

        } else if ($this->quiz->timeclose && $this->timenow > $this->quiz->timeclose) {
            $result[] = get_string('quizclosed', 'quiz', userdate($this->quiz->timeclose));

        } else {
            if ($this->quiz->timeopen) {
                $result[] = get_string('quizopenedon', 'quiz', userdate($this->quiz->timeopen));
            }
            if ($this->quiz->timeclose) {
                $result[] = get_string('quizcloseson', 'quiz', userdate($this->quiz->timeclose));
            }
        }

        return $result;
    }

    public function prevent_access() {
        $message = get_string('notavailable', 'quizaccess_openclosedate');

        if ($this->timenow < $this->quiz->timeopen) {
            return $message;
        }

        if (!$this->quiz->timeclose) {
            return false;
        }

        if ($this->timenow <= $this->quiz->timeclose) {
            return false;
        }

        if ($this->quiz->overduehandling != 'graceperiod') {
            return $message;
        }

        if ($this->timenow <= $this->quiz->timeclose + $this->quiz->graceperiod) {
            return false;
        }

        return $message;
    }

    public function is_finished($numprevattempts, $lastattempt) {
        return $this->quiz->timeclose && $this->timenow > $this->quiz->timeclose;
    }

    public function end_time($attempt) {
        if ($this->quiz->timeclose) {
            return $this->quiz->timeclose;
        }
        return false;
    }

    public function time_left_display($attempt, $timenow) {
        // If this is a teacher preview after the close date, do not show
        // the time.
        if ($attempt->preview && $timenow > $this->quiz->timeclose) {
            return false;
        }
        // Otherwise, return to the time left until the close date, providing that is
        // less than QUIZ_SHOW_TIME_BEFORE_DEADLINE.
        $endtime = $this->end_time($attempt);
        if ($endtime !== false && $timenow > $endtime - QUIZ_SHOW_TIME_BEFORE_DEADLINE) {
            return $endtime - $timenow;
        }
        return false;
    }
}
