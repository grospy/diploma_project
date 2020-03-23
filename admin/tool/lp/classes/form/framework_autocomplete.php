<?php
//


/**
 * Framework selector field.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp\form;

use coding_exception;
use MoodleQuickForm_autocomplete;
use \core_competency\competency_framework;

global $CFG;
require_once($CFG->libdir . '/form/autocomplete.php');


/**
 * Form field type for choosing a framework.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class framework_autocomplete extends MoodleQuickForm_autocomplete {

    /** @var bool Only visible frameworks? */
    protected $onlyvisible = false;

    /**
     * Constructor.
     *
     * @param string $elementName Element name
     * @param mixed $elementLabel Label(s) for an element
     * @param array $options Options to control the element's display
     *                       Valid options are:
     *                       - context context The context.
     *                       - contextid int The context id.
     *                       - multiple bool Whether or not the field accepts more than one values.
     *                       - onlyvisible bool Whether or not only visible framework can be listed.
     */
    public function __construct($elementName = null, $elementLabel = null, $options = array()) {
        $contextid = null;
        if (!empty($options['contextid'])) {
            $contextid = $options['contextid'];
        } else if (!empty($options['context'])) {
            $contextid = $options['context']->id;
        }

        $this->onlyvisible = !empty($options['onlyvisible']);

        $validattributes = array(
            'ajax' => 'tool_lp/frameworks_datasource',
            'data-contextid' => $contextid,
            'data-onlyvisible' => $this->onlyvisible ? '1' : '0',
        );
        if (!empty($options['multiple'])) {
            $validattributes['multiple'] = 'multiple';
        }

        parent::__construct($elementName, $elementLabel, array(), $validattributes);
    }

    /**
     * Set the value of this element.
     *
     * @param  string|array $value The value to set.
     * @return boolean
     */
    public function setValue($value) {
        global $DB;
        $values = (array) $value;
        $ids = array();

        foreach ($values as $onevalue) {
            if (!empty($onevalue) && (!$this->optionExists($onevalue)) &&
                    ($onevalue !== '_qf__force_multiselect_submission')) {
                array_push($ids, $onevalue);
            }
        }

        if (empty($ids)) {
            return $this->setSelected(array());
        }

        // Logic here is simulating API.
        $toselect = array();
        list($insql, $inparams) = $DB->get_in_or_equal($ids, SQL_PARAMS_NAMED, 'param');
        $frameworks = competency_framework::get_records_select("id $insql", $inparams, 'shortname');
        foreach ($frameworks as $framework) {
            if (!has_any_capability(array('moodle/competency:competencyview', 'moodle/competency:competencymanage'),
                    $framework->get_context())) {
                continue;
            } else if ($this->onlyvisible && !$framework->get('visible')) {
                continue;
            }
            $this->addOption($framework->get('shortname') . ' ' . $framework->get('idnumber'), $framework->get('id'));
            array_push($toselect, $framework->get('id'));
        }

        return $this->setSelected($toselect);
    }
}
