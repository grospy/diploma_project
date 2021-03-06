<?php

//

/**
 * @package    moodlecore
 * @subpackage backup-interfaces
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Interface to apply to all the classes we want to be able to write to logs
 *
 * Any class being part of one backup/restore and needing to senf informatio
 * to logs must implement this interface (and have access to the @logger
 * instantiated object)
 *
 * TODO: Finish phpdocs
 */
interface loggable {

    /**
     * This function will be responsible for handling the params, and to call
     * to the corresponding logger->process() once all modifications in params
     * have been performed
     */
    public function log($message, $level, $a = null, $depth = null, $display = false);
}
