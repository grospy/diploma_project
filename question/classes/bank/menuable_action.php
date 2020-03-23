<?php
//

/**
 * Interface to indicate that a question bank column can go in the action menu.
 *
 * @package   core_question
 * @copyright 2019 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\bank;
defined('MOODLE_INTERNAL') || die();


/**
 * Interface to indicate that a question bank column can go in the action menu.
 *
 * If a question bank column implements this interface, and if the {@link edit_menu_column}
 * is present in the question bank view, then the 'column' will be shown as an entry in the
 * edit menu instead of as a separate column.
 *
 * Probably most columns that want to implement this will be subclasses of
 * {@link action_column_base}, and most such columns should probably implement
 * this interface.
 *
 * If your column is a simple action, you can probably save duplicated code by
 * using the base class action_column_menuable as an easy way to implement both
 * action_column_base and this interface.
 *
 * @copyright 2019 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface menuable_action {

    /**
     * Return the appropriate action menu link, or null if it does not apply to this question.
     *
     * @param \stdClass $question data about the question being displayed in this row.
     * @return \action_menu_link|null the action, if applicable to this question.
     */
    public function get_action_menu_link(\stdClass $question): ?\action_menu_link;
}
