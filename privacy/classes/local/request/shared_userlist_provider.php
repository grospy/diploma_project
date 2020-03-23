<?php
//

/**
 * This file contains an interface to describe classes which provide user data in some form for shared providers.
 *
 * @package     core_privacy
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The interface is used to describe a provider which is capable of identifying the users who have data within it.
 *
 * It describes data how these requests are serviced in a specific format.
 *
 * @package     core_privacy
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 */
interface shared_userlist_provider extends userlist_provider {
}
