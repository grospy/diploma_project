//

/**
 * This is an empty module, that is required before all other modules.
 * Because every module is returned from a request for any other module, this
 * forces the loading of all modules with a single request.
 *
 * This function also sets up the listeners for ajax requests so we can tell
 * if any requests are still in progress.
 *
 * @module     core/first
 * @package    core
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      2.9
 */
define(['jquery'], function($) {
    $(document).bind("ajaxStart", function() {
        M.util.js_pending('jq');
    }).bind("ajaxStop", function() {
        M.util.js_complete('jq');
    });
});
