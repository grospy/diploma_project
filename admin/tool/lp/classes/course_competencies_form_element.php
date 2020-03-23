<?php
//


/**
 * Course competencies element.
 *
 * @package   tool_lp
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

use core_competency\api;
use core_competency\external\competency_exporter;
require_once($CFG->libdir . '/form/autocomplete.php');

/**
 * Course competencies element.
 *
 * @package   tool_lp
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_lp_course_competencies_form_element extends MoodleQuickForm_autocomplete {

    /**
     * Constructor
     *
     * @param string $elementName Element name
     * @param mixed $elementLabel Label(s) for an element
     * @param array $options Options to control the element's display
     * @param mixed $attributes Either a typical HTML attribute string or an associative array.
     */
    public function __construct($elementName=null, $elementLabel=null, $options=array(), $attributes=null) {
        global $OUTPUT;

        if ($elementName == null) {
            // This is broken quickforms messing with the constructors.
            return;
        }

        if (!isset($options['courseid'])) {
            throw new coding_exception('Course id is required for the course_competencies form element');
        }
        $courseid = $options['courseid'];

        if (!empty($options['cmid'])) {
            $current = \core_competency\api::list_course_module_competencies_in_course_module($options['cmid']);
            $ids = array();
            foreach ($current as $coursemodulecompetency) {
                array_push($ids, $coursemodulecompetency->get('competencyid'));
            }
            $this->setValue($ids);
        }

        $competencies = api::list_course_competencies($courseid);
        $validoptions = array();

        $context = context_course::instance($courseid);
        foreach ($competencies as $competency) {
            // We don't need to show the description as part of the options, so just set this to null.
            $competency['competency']->set('description', null);
            $exporter = new competency_exporter($competency['competency'], array('context' => $context));
            $templatecontext = array('competency' => $exporter->export($OUTPUT));
            $id = $competency['competency']->get('id');
            $validoptions[$id] = $OUTPUT->render_from_template('tool_lp/competency_summary', $templatecontext);
        }
        $attributes['tags'] = false;
        $attributes['multiple'] = 'multiple';
        parent::__construct($elementName, $elementLabel, $validoptions, $attributes);
    }
}
