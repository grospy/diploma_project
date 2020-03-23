<?php
//

/**
 * mod_folder data generator.
 *
 * @package    mod_folder
 * @category   test
 * @copyright  2013 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * mod_folder data generator class.
 *
 * @package    mod_folder
 * @category   test
 * @copyright  2013 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_folder_generator extends testing_module_generator {

    public function create_instance($record = null, array $options = null) {
        // Add default values for folder.
        $record = (array)$record + array('display' => 0);
        if (!isset($record['showexpanded'])) {
            $record['showexpanded'] = get_config('folder', 'showexpanded');
        }
        if (!isset($record['files'])) {
            $record['files'] = file_get_unused_draft_itemid();
        }
        return parent::create_instance($record, (array)$options);
    }
}
