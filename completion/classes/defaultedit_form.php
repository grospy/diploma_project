<?php
//

/**
 * Default activity completion form
 *
 * @package     core_completion
 * @copyright   2017 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Default activity completion form
 *
 * @package     core_completion
 * @copyright   2017 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_completion_defaultedit_form extends core_completion_edit_base_form {
    /** @var array */
    protected $modules;
    /** @var array */
    protected $_modnames;

    /**
     * Returns list of types of selected modules
     *
     * @return array modname=>modfullname
     */
    protected function get_module_names() {
        if ($this->_modnames !== null) {
            return $this->_modnames;
        }
        $this->_modnames = [];
        foreach ($this->modules as $module) {
            $this->_modnames[$module->name] = $module->formattedname;
        }
        return $this->_modnames;
    }

    /**
     * Returns an instance of component-specific module form for the first selected module
     *
     * @return moodleform_mod|null
     */
    protected function get_module_form() {
        global $CFG, $PAGE;

        if ($this->_moduleform) {
            return $this->_moduleform;
        }

        $modnames = array_keys($this->get_module_names());
        $modname = $modnames[0];
        $course = $this->course;

        $modmoodleform = "$CFG->dirroot/mod/$modname/mod_form.php";
        if (file_exists($modmoodleform)) {
            require_once($modmoodleform);
        } else {
            print_error('noformdesc');
        }

        list($module, $context, $cw, $cmrec, $data) = prepare_new_moduleinfo_data($course, $modname, 0);
        $data->return = 0;
        $data->sr = 0;
        $data->add = $modname;

        // Initialise the form but discard all JS requirements it adds, our form has already added them.
        $mformclassname = 'mod_'.$modname.'_mod_form';
        $PAGE->start_collecting_javascript_requirements();
        $this->_moduleform = new $mformclassname($data, 0, $cmrec, $course);
        $PAGE->end_collecting_javascript_requirements();

        return $this->_moduleform;
    }

    /**
     * Form definition,
     */
    public function definition() {
        $this->course = $this->_customdata['course'];
        $this->modules = $this->_customdata['modules'];

        $mform = $this->_form;

        foreach ($this->modules as $modid => $module) {
            $mform->addElement('hidden', 'modids['.$modid.']', $modid);
            $mform->setType('modids['.$modid.']', PARAM_INT);
        }

        parent::definition();

        $modform = $this->get_module_form();
        if ($modform) {
            $modnames = array_keys($this->get_module_names());
            $modname = $modnames[0];
            // Pre-fill the form with the current completion rules of the first selected module type.
            list($module, $context, $cw, $cmrec, $data) = prepare_new_moduleinfo_data($this->course, $modname, 0);
            $data = (array)$data;
            $modform->data_preprocessing($data);
            // Unset fields that will conflict with this form and set data to this form.
            unset($data['cmid']);
            unset($data['modids']);
            unset($data['id']);
            $this->set_data($data);
        }
    }
}