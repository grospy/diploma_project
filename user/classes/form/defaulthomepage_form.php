<?php
//

/**
 * Form to allow user to set their default home page
 *
 * @package     core_user
 * @copyright   2019 Paul Holden <paulh@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_user\form;

use lang_string;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/lib/formslib.php');

/**
 * Form class
 *
 * @copyright   2019 Paul Holden <paulh@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class defaulthomepage_form extends \moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        $mform = $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $options = [
            HOMEPAGE_SITE => new lang_string('site'),
            HOMEPAGE_MY => new lang_string('mymoodle', 'admin'),
        ];

        $mform->addElement('select', 'defaulthomepage', get_string('defaulthomepageuser'), $options);
        $mform->addHelpButton('defaulthomepage', 'defaulthomepageuser');
        $mform->setDefault('defaulthomepage', HOMEPAGE_MY);

        $this->add_action_buttons(true, get_string('savechanges'));
    }
}
