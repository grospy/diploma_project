<?php
//

/**
 * File unit tests
 *
 * @package    cachestore_file
 * @copyright  2013 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Include the necessary evils.
global $CFG;
require_once($CFG->dirroot.'/cache/tests/fixtures/stores.php');
require_once($CFG->dirroot.'/cache/stores/file/lib.php');

/**
 * File unit test class.
 *
 * @package    cachestore_file
 * @copyright  2013 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cachestore_file_test extends cachestore_tests {
    /**
     * Returns the file class name
     * @return string
     */
    protected function get_class_name() {
        return 'cachestore_file';
    }

    /**
     * Testing cachestore_file::get with prescan enabled and with
     * deleting the cache between the prescan and the call to get.
     *
     * The deleting of cache simulates some other process purging
     * the cache.
     */
    public function test_cache_get_with_prescan_and_purge() {
        global $CFG;

        $definition = cache_definition::load_adhoc(cache_store::MODE_REQUEST, 'cachestore_file', 'phpunit_test');
        $name = 'File test';

        $path = make_cache_directory('cachestore_file_test');
        $cache = new cachestore_file($name, array('path' => $path, 'prescan' => true));
        $cache->initialise($definition);

        $cache->set('testing', 'value');

        $path  = make_cache_directory('cachestore_file_test');
        $cache = new cachestore_file($name, array('path' => $path, 'prescan' => true));
        $cache->initialise($definition);

        // Let's pretend that some other process purged caches.
        remove_dir($CFG->cachedir.'/cachestore_file_test', true);
        make_cache_directory('cachestore_file_test');

        $cache->get('testing');
    }
}