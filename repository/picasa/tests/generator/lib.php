<?php
//

/**
 * Picasa repository data generator
 *
 * @package    repository_picasa
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Picasa repository data generator class
 *
 * @package    repository_picasa
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_picasa_generator extends testing_repository_generator {

    /**
     * Fill in type record defaults.
     *
     * @param array $record
     * @return array
     */
    protected function prepare_type_record(array $record) {
        $record = parent::prepare_type_record($record);
        if (!isset($record['clientid'])) {
            $record['clientid'] = 'clientid';
        }
        if (!isset($record['secret'])) {
            $record['secret'] = 'secret';
        }
        return $record;
    }

}
