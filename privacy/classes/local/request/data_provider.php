<?php
//

/**
 * This file contains the \core_privacy\local\request\data_provider interface to describe
 * a class which provides data in some form.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The data_provider interface is used to describe a provider
 * which services user requests in any fashion. This includes both
 * -- component <-> core; and
 * -- component <-> component.
 *
 * It does not define a specific way of doing so and different types of
 * data will need to extend this interface in order to define their own
 * contract.
 *
 * It should not be implemented directly, but should be extended by other
 * interfaces in core.
 *
 * This is the base interface for any component which stores any form of
 * user data.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 */
interface data_provider {
}
