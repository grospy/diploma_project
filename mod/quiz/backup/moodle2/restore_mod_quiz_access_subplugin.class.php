<?php
//

/**
 * Restore code for the quizaccess_honestycheck plugin.
 *
 * @package   mod_quiz
 * @copyright 2011 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Base class for restoring up all the quiz settings and attempt data for an
 * access rule quiz sub-plugin.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_mod_quiz_access_subplugin extends restore_subplugin {

    /**
     * Use this method to describe the XML paths that store your sub-plugin's
     * settings for a particular quiz.
     */
    protected function define_quiz_subplugin_structure() {
        // Do nothing by default.
    }

    /**
     * Use this method to describe the XML paths that store your sub-plugin's
     * settings for a particular quiz attempt.
     */
    protected function define_attempt_subplugin_structure() {
        // Do nothing by default.
    }
}
