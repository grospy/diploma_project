<?php
//

/**
 * Cache data source for the time of the last message between users.
 *
 * @package    core_message
 * @category   cache
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message;

defined('MOODLE_INTERNAL') || die();

/**
 * Cache data source for the time of the last message in a conversation.
 *
 * @package    core_message
 * @category   cache
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class time_last_message_between_users implements \cache_data_source {

    /** @var time_last_message_between_users the singleton instance of this class. */
    protected static $instance = null;

    /**
     * Returns an instance of the data source class that the cache can use for loading data using the other methods
     * specified by the cache_data_source interface.
     *
     * @param \cache_definition $definition
     * @return object
     */
    public static function get_instance_for_cache(\cache_definition $definition) {
        if (is_null(self::$instance)) {
            self::$instance = new time_last_message_between_users();
        }
        return self::$instance;
    }

    /**
     * Loads the data for the key provided ready formatted for caching.
     *
     * @param string|int $key The key to load.
     * @return mixed What ever data should be returned, or false if it can't be loaded.
     */
    public function load_for_cache($key) {
        $message = api::get_most_recent_conversation_message($key);

        if ($message) {
            return $message->timecreated;
        } else {
            return null;
        }
    }

    /**
     * Loads several keys for the cache.
     *
     * @param array $keys An array of keys each of which will be string|int.
     * @return array An array of matching data items.
     */
    public function load_many_for_cache(array $keys) {
        $results = [];

        foreach ($keys as $key) {
            $results[] = $this->load_for_cache($key);
        }

        return $results;
    }
}
