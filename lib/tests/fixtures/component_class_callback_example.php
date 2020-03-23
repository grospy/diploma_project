<?php
//

/**
 * Fixtures for component_class_callback tests.
 *
 * @package    core
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class fixture for component_class_callback.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_component_class_callback_example {
    /**
     * Function which returns the input value.
     *
     * @param   mixed   $output
     * @return  mixed
     */
    public static function method_returns_value($output) {
        return $output;
    }

    /**
     * Function which returns all args.
     *
     * @return  mixed
     */
    public static function method_returns_all_params() {
        return count(func_get_args());
    }
}

/**
 * Class fixture for component_class_callback which extends another class.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_component_class_callback_child_example extends test_component_class_callback_example {
}
