//

/**
 * Simple API for set/get to localstorage, with cacherev expiration.
 *
 * @module     core/localstorage
 * @package    core
 * @class      localstorage
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      2.9
 */
define(['core/config', 'core/storagewrapper'], function(config, StorageWrapper) {

    // Private functions and variables.
    /** @var {Object} StorageWrapper - Wraps browsers localStorage object */
    var storage = new StorageWrapper(window.localStorage);

    return /** @alias module:core/localstorage */ {
        /**
         * Get a value from local storage. Remember - all values must be strings.
         *
         * @method get
         * @param {string} key The cache key to check.
         * @return {boolean|string} False if the value is not in the cache, or some other error - a string otherwise.
         */
        get: function(key) {
            return storage.get(key);
        },

        /**
         * Set a value to local storage. Remember - all values must be strings.
         *
         * @method set
         * @param {string} key The cache key to set.
         * @param {string} value The value to set.
         * @return {boolean} False if the value can't be saved in the cache, or some other error - true otherwise.
         */
        set: function(key, value) {
            return storage.set(key, value);
        }

    };
});
