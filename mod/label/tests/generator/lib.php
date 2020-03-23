<?php
//

/**
 * mod_label data generator
 *
 * @package    mod_label
 * @category   test
 * @copyright  2013 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Label module data generator class
 *
 * @package    mod_label
 * @category   test
 * @copyright  2013 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_label_generator extends testing_module_generator {

    public function create_instance($record = null, array $options = null) {
        $record = (array)$record;
        $record['showdescription'] = 1;
        return parent::create_instance($record, $options);
    }
}
