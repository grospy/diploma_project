<?php
//

/**
 * Upload an h5p content to update the content libraries.
 *
 * @package    core_h5p
 * @copyright  2019 Amaia Anabitarte <amaia@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_h5p\form;

defined('MOODLE_INTERNAL') || die();

/**
 * Upload a zip or h5p content to update the content libraries.
 *
 * @copyright  2019 Amaia Anabitarte <amaia@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class uploadlibraries_form extends \moodleform {
    /**
     * Form definition.
     */
    public function definition() {
        $mform = $this->_form;
        $mform->addElement('header', 'settingsheader', get_string('uploadlibraries', 'core_h5p'));

        $filemanageroptions = array(
            'accepted_types' => array('.h5p', '.zip'),
            'maxbytes' => 0,
            'maxfiles' => 1,
            'subdirs' => 0
        );

        $mform->addElement('filepicker', 'h5ppackage', get_string('h5ppackage', 'core_h5p'),
            null, $filemanageroptions);
        $mform->addHelpButton('h5ppackage', 'h5ppackage', 'core_h5p');
        $mform->addRule('h5ppackage', null, 'required');

        $mform->addElement('submit', 'uploadlibraries', get_string('uploadlibraries', 'core_h5p'));
    }
}
