<?php
//

/**
 * Progress handler that ignores progress entirely.
 *
 * @package    core
 * @copyright  2013 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\progress;

defined('MOODLE_INTERNAL') || die();

/**
 * Progress handler that ignores progress entirely.
 *
 * @package core
 * @copyright 2013 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class none extends base {
    /**
     * When progress is updated, do nothing.
     *
     * @see \core\progress\base::update_progress()
     */
    public function update_progress() {
        // Do nothing.
    }
}
