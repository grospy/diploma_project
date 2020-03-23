<?php

//

/**
 * @package    moodlecore
 * @subpackage backup-structure
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * TODO: Finish phpdocs
 */

/**
 * Abstract class representing one attribute atom (name/value) piece of information
 */
abstract class base_attribute extends base_atom {

    public function to_string($showvalue = false) {
        return '@' . parent::to_string($showvalue);
    }
}
