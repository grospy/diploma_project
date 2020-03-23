<?php
//
/**
 * Form alignment for editing.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->libdir . '/badgeslib.php');

/**
 * Form to edit alignment.
 *
 * @copyright  2018 Tung Thai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Tung Thai <Tung.ThaiDuc@nashtechglobal.com>
 */
class alignment_form extends moodleform {

    /**
     * Defines the form.
     */
    public function definition() {
        global $DB;
        $mform = $this->_form;
        $badge = $this->_customdata['badge'];
        $action = $this->_customdata['action'];
        $alignmentid = $this->_customdata['alignmentid'];
        $mform->addElement('header', 'alignment', get_string('alignment', 'badges'));
        $mform->addElement('text', 'targetname', get_string('targetname', 'badges'), array('size' => '70'));
        $mform->setType('targetname', PARAM_TEXT);
        $mform->addRule('targetname', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addRule('targetname', null, 'required');
        $mform->addHelpButton('targetname', 'targetname', 'badges');
        $mform->addElement('text', 'targeturl', get_string('targeturl', 'badges'), array('size' => '70'));
        $mform->setType('targeturl', PARAM_URL);
        $mform->addRule('targeturl', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addRule('targeturl', null, 'required');
        $mform->addHelpButton('targeturl', 'targeturl', 'badges');
        $mform->addElement('text', 'targetframework', get_string('targetframework', 'badges'), array('size' => '70'));
        $mform->setType('targetframework', PARAM_TEXT);
        $mform->addRule('targetframework', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('targetframework', 'targetframework', 'badges');
        $mform->addElement('text', 'targetcode', get_string('targetcode', 'badges'), array('size' => '70'));
        $mform->setType('targetcode', PARAM_TEXT);
        $mform->addRule('targetcode', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('targetcode', 'targetcode', 'badges');
        $mform->addElement('textarea', 'targetdescription', get_string('targetdescription', 'badges'),
            'wrap="virtual" rows="8" cols="70"');
        $this->add_action_buttons();
        if ($action == 'edit' || $alignmentid) {
            $alignment = new stdClass();
            $alignment = $DB->get_record_select('badge_alignment', 'id = ?', array($alignmentid));
            $this->set_data($alignment);
            // Freeze all elements if badge is active or locked.
            if ($badge->is_active() || $badge->is_locked()) {
                $mform->hardFreezeAllVisibleExcept(array());
            }
        }
    }

    /**
     * Validate the data from the form.
     *
     * @param  array $data form data
     * @param  array $files form files
     * @return array An array of error messages.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        if (!empty($data['targeturl']) && !preg_match('@^https?://.+@', $data['targeturl'])) {
            $errors['targeturl'] = get_string('invalidurl', 'badges');
        }
        return $errors;
    }
}
