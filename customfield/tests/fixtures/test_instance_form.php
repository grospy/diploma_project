<?php
//

/**
 * Class core_customfield_test_instance_form
 *
 * @package     core_customfield
 * @copyright   2019 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/formslib.php');

/**
 * Class core_customfield_test_instance_form
 *
 * @package     core_customfield
 * @copyright   2019 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_customfield_test_instance_form extends moodleform {
    /** @var \core_customfield\handler */
    protected $handler;

    /** @var stdClass */
    protected $instance;

    /**
     * Form definition
     */
    public function definition() {
        $this->handler = $this->_customdata['handler'];
        $this->instance = $this->_customdata['instance'];

        $this->_form->addElement('hidden', 'id');
        $this->_form->setType('id', PARAM_INT);

        $this->handler->instance_form_definition($this->_form, $this->instance->id);

        $this->add_action_buttons();

        $this->handler->instance_form_before_set_data($this->instance);
        $this->set_data($this->instance);
    }

    /**
     * Definition after data
     */
    public function definition_after_data() {
        $this->handler->instance_form_definition_after_data($this->_form, $this->instance->id);
    }

    /**
     * Form validation
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        return $this->handler->instance_form_validation($data, $files);
    }
}
