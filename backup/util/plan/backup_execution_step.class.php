<?php

//

/**
 * @package moodlecore
 * @subpackage backup-plan
 * @copyright 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Abstract class defining the needed stuff to execute code on backup
 *
 * TODO: Finish phpdocs
 */
abstract class backup_execution_step extends backup_step {

    public function execute() {
        // Simple, for now
        return $this->define_execution();
    }

// Protected API starts here

    /**
     * Function that will contain all the code to be executed
     */
    abstract protected function define_execution();
}
