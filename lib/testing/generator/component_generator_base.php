<?php
//

/**
 * Component generator base class.
 *
 * @package   core
 * @category  test
 * @copyright 2013 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Component generator base class.
 *
 * Extend in path/to/component/tests/generator/lib.php as
 * class type_plugin_generator extends component_generator_base
 * Note that there are more specific classes to extend for mods and blocks.
 *
 * @copyright 2013 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class component_generator_base {

    /**
     * @var testing_data_generator
     */
    protected $datagenerator;

    /**
     * Constructor.
     * @param testing_data_generator $datagenerator
     */
    public function __construct(testing_data_generator $datagenerator) {
        $this->datagenerator = $datagenerator;
    }

    /**
     * To be called from data reset code only,
     * do not use in tests.
     * @return void
     */
    public function reset() {
    }
}
