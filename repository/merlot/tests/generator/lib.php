<?php
//

/**
 * Merlot repository data generator
 *
 * @package    repository_merlot
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Merlot repository data generator class
 *
 * @package    repository_merlot
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_merlot_generator extends testing_repository_generator {

    /**
     * Fill in type record defaults.
     *
     * @param array $record
     * @return array
     */
    protected function prepare_type_record(array $record) {
        $record = parent::prepare_type_record($record);
        if (!isset($record['licensekey'])) {
            $record['licensekey'] = 'licensekey';
        }
        return $record;
    }

}
