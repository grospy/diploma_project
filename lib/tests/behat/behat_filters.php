<?php
//

/**
 * Steps definitions related to filters.
 *
 * @package    core
 * @category   test
 * @copyright  2018 the Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Note: You cannot use MOODLE_INTERNAL test here, or include files which do so.
// This file is required by behat before including /config.php.

require_once(__DIR__ . '/../../behat/behat_base.php');

/**
 * Steps definitions related to filters.
 *
 * @package    core
 * @category   test
 * @copyright  2018 the Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_filters extends behat_base {

    /**
     * Set the global filter configuration.
     *
     * @Given /^the "(?P<filter_name>(?:[^"]|\\")*)" filter is "(on|off|disabled)"$/
     *
     * @param string $filtername the name of a filter, e.g. 'glossary'.
     * @param string $statename 'on', 'off' or 'disabled'.
     */
    public function the_filter_is($filtername, $statename) {
        require_once(__DIR__ . '/../../filterlib.php');

        switch ($statename) {
            case 'on':
                $state = TEXTFILTER_ON;
                break;
            case 'off':
                $state = TEXTFILTER_OFF;
                break;
            case 'disabled':
                $state = TEXTFILTER_DISABLED;
                break;
            default:
                throw new coding_exception('Unknown filter state: ' . $statename);
        }
        filter_set_global_state($filtername, $state);
    }

    /**
     * Set the global filter target.
     *
     * @Given /^the "(?P<filter_name>(?:[^"]|\\")*)" filter applies to "(content|content and headings)"$/
     *
     * @param string $filtername the name of a filter, e.g. 'glossary'.
     * @param string $filtertarget 'content' or 'content and headings'.
     */
    public function the_filter_applies_to($filtername, $filtertarget) {
        switch ($filtertarget) {
            case 'content and headings':
                filter_set_applies_to_strings($filtername, 1);
                break;
            case 'content':
                filter_set_applies_to_strings($filtername, 0);
                break;
            default:
                throw new coding_exception('Unknown filter target: ' . $filtertarget);
        }
    }
}
