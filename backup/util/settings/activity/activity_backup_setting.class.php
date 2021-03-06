<?php

//

/**
 * @package    moodlecore
 * @subpackage backup-settings
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Abstract class containing all the common stuff for activity backup settings
 *
 * TODO: Finish phpdocs
 */
abstract class activity_backup_setting extends backup_setting {

    public function __construct($name, $vtype, $value = null, $visibility = self::VISIBLE, $status = self::NOT_LOCKED) {
        $this->level = self::ACTIVITY_LEVEL;
        parent::__construct($name, $vtype, $value, $visibility, $status);
    }
}
