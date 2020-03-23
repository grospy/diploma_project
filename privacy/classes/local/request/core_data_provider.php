<?php
//

/**
 * This file contains the \core_privacy\local\request\core_data_provider interface to describe
 * classes which provide data in some form to core.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The core_data_provider interface is used to describe a provider which
 * services user requests between components and core.
 *
 * It does not define a specific way of doing so and different types of
 * data will need to extend this interface in order to define their own
 * contract.
 *
 * It should not be implemented directly, but should be extended by other
 * interfaces in core.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 */
interface core_data_provider extends data_provider {
}
