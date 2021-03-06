<?php
//

/**
 * mod_choice data generator.
 *
 * @package mod_choice
 * @category test
 * @copyright 2013 Adrian Greeve <adrian@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * mod_choice data generator class.
 *
 * @package mod_choice
 * @category test
 * @copyright 2013 Adrian Greeve <adrian@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_choice_generator extends testing_module_generator {

    public function create_instance($record = null, array $options = null) {
        $record = (object)(array)$record;

        if (!isset($record->timemodified)) {
            $record->timemodified = time();
        }
        if (!isset($record->option)) {
            $record->option = array();
            $record->option[] = 'Soft Drink';
            $record->option[] = 'Beer';
            $record->option[] = 'Wine';
            $record->option[] = 'Spirits';
        } else if (!is_array($record->option)) {
            $record->option = preg_split('/\s*,\s*/', trim($record->option), -1, PREG_SPLIT_NO_EMPTY);
        }
        return parent::create_instance($record, (array)$options);
    }
}
