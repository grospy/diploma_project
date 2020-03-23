<?php
//

/**
 * The qbank_chooser renderable.
 *
 * @package    core_question
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\output;
defined('MOODLE_INTERNAL') || die();

use context_course;
use core\output\chooser_section;
use lang_string;
use moodle_url;
use question_bank;


/**
 * The qbank_chooser renderable class.
 *
 * @package    core_question
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbank_chooser extends \core\output\chooser {

    /**
     * Constructor.
     *
     * @param array $real The real question types.
     * @param array $fake The fake question types.
     * @param stdClass $course The course.
     * @param array $hiddenparams Hidden parameters.
     * @param context $context The relevant context.
     */
    public function __construct($real, $fake, $course, $hiddenparams, $context) {
        $sections = [];
        $sections[] = new chooser_section('questions', new lang_string('questions', 'question'),
                array_map(function($qtype) use ($context) {
                    return new qbank_chooser_item($qtype, $context);
                }, $real));

        if (!empty($fake)) {
            $sections[] = new chooser_section('other', new lang_string('other'),
                array_map(function ($qtype) use ($context) {
                    return new qbank_chooser_item($qtype, $context);
                }, $fake));
        }

        parent::__construct(new moodle_url('/question/question.php'),
                new lang_string('chooseqtypetoadd', 'question'), $sections, 'qtype');

        $this->set_instructions(new lang_string('selectaqtypefordescription', 'question'));

        $this->set_method('get');
        $this->add_param('courseid', $course->id);
        foreach ($hiddenparams as $k => $v) {
            $this->add_param($k, $v);
        }
    }

    /**
     * Get an instance of the question bank chooser.
     *
     * @param stdClass $course The course.
     * @param array $hiddenparams Hidden parameters.
     * @param array|null $allowedqtypes Allowed question types.
     * @return qbank_chooser
     */
    public static function get($course, $hiddenparams, array $allowedqtypes = null) {
        $realqtypes = array();
        $fakeqtypes = array();

        foreach (question_bank::get_creatable_qtypes() as $qtypename => $qtype) {
            if ($allowedqtypes && !in_array($qtypename, $allowedqtypes)) {
                continue;
            }
            if ($qtype->is_real_question_type()) {
                $realqtypes[] = $qtype;
            } else {
                $fakeqtypes[] = $qtype;
            }
        }

        return new static($realqtypes, $fakeqtypes, $course, $hiddenparams, context_course::instance($course->id));
    }

}
