<?php
//

/**
 * A form inside a namespace to be used by unit tests.
 *
 * See issue MDL-56233
 *
 * @package    core
 * @author     Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright  2016 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_unittests\namespaced_form;

defined('MOODLE_INTERNAL') || die();

/**
 * exampleform class.
 *
 * @package    core
 * @author     Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright  2016 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class exampleform extends \moodleform {
    /**
     * Create a simple form definition.
     */
    public function definition() {
        $mform = $this->_form;
        $mform->addElement('text', 'title', 'title_value');
        $mform->setType('title', PARAM_TEXT);
    }
}
