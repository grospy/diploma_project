<?php

//

/**
 * @package    moodlecore
 * @subpackage backup-interfaces
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Interface to apply to all the classes we want to be executable (plan/part/task)
 *
 * TODO: Finish phpdocs
 */
interface executable {

    /**
     * This function will perform all the actions necessary to achieve the execution
     * of the plan/part/task
     */
    public function execute();
}
