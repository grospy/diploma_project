<?php
//


/**
 * @package    core_tag
 * @category   tag
 * @copyright  2007 Luiz Cruz <luiz.laydner@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * Defines the form for editing tags
 *
 * @package    core_tag
 * @category   tag
 * @copyright  2007 Luiz Cruz <luiz.laydner@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tag_edit_form extends moodleform {

    /**
     * Overrides the abstract moodleform::definition method for defining what the form that is to be
     * presented to the user.
     */
    function definition () {

        $mform =& $this->_form;

        $mform->addElement('header', 'tag', get_string('description','tag'));

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'returnurl');
        $mform->setType('returnurl', PARAM_LOCALURL);

        $systemcontext   = context_system::instance();

        if (has_capability('moodle/tag:manage', $systemcontext)) {
            $mform->addElement('text', 'rawname', get_string('name', 'tag'),
                    'maxlength="'.TAG_MAX_LENGTH.'" size="'.TAG_MAX_LENGTH.'"');
            $mform->setType('rawname', PARAM_TAG);
        }

        $mform->addElement('editor', 'description_editor', get_string('description', 'tag'), null, $this->_customdata['editoroptions']);

        if (has_capability('moodle/tag:manage', $systemcontext)) {
            $mform->addElement('checkbox', 'isstandard', get_string('standardtag', 'tag'));
        }

        $mform->addElement('tags', 'relatedtags', get_string('relatedtags', 'tag'),
                array('tagcollid' => $this->_customdata['tag']->tagcollid));

        $this->add_action_buttons(true, get_string('updatetag', 'tag'));

    }

    /**
     * Custom form validation
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (isset($data['rawname'])) {
            $newname = core_text::strtolower($data['rawname']);
            $tag = $this->_customdata['tag'];
            if ($tag->name != $newname) {
                // The name has changed, let's make sure it's not another existing tag.
                if (core_tag_tag::get_by_name($tag->tagcollid, $newname)) {
                    // Something exists already, so flag an error.
                    $errors['rawname'] = get_string('namesalreadybeeingused', 'tag');
                }
            }
        }

        return $errors;
    }

}
