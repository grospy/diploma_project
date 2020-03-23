<?php
//

/**
 * This file contains the forms to create and edit an instance of this module
 *
 * @package   mod_assignment
 * @copyright 2007 Petr Skoda
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Disabled assignment settings form.
 *
 * @package   mod_assignment
 * @copyright 2013 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_assignment_mod_form extends moodleform_mod {

    /**
     * Called to define this moodle form
     *
     * @return void
     */
    public function definition() {
        print_error('assignmentdisabled', 'assignment');
    }


}
