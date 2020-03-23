<?php
//

/**
 * Flickr repository data generator
 *
 * @package    repository_flickr
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Flickr repository data generator class
 *
 * @package    repository_flickr
 * @category   test
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_flickr_generator extends testing_repository_generator {

    /**
     * Fill in type record defaults.
     *
     * @param array $record
     * @return array
     */
    protected function prepare_type_record(array $record) {
        $record = parent::prepare_type_record($record);
        if (!isset($record['api_key'])) {
            $record['api_key'] = 'api_key';
        }
        if (!isset($record['secret'])) {
            $record['secret'] = 'secret';
        }
        return $record;
    }

}
