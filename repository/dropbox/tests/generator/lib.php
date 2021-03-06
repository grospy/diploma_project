<?php
//

/**
 * Dropbox repository data generator
 *
 * @package    repository_dropbox
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Dropbox repository data generator class
 *
 * @package    repository_dropbox
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_dropbox_generator extends testing_repository_generator {

    /**
     * Fill in type record defaults.
     *
     * @param array $record
     * @return array
     */
    protected function prepare_type_record(array $record) {
        $record = parent::prepare_type_record($record);
        if (!isset($record['dropbox_key'])) {
            $record['dropbox_key'] = 'key';
        }
        if (!isset($record['dropbox_secret'])) {
            $record['dropbox_secret'] = 'secret';
        }
        if (!isset($record['dropbox_cachelimit'])) {
            $record['dropbox_cachelimit'] = 0;
        }
        return $record;
    }

}
