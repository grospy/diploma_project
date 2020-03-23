<?php
//

/**
 * This file is used to call any registered externallib function in Moodle.
 *
 * It will process more than one request and return more than one response if required.
 * It is recommended to add webservice functions and re-use this script instead of
 * writing any new custom ajax scripts.
 *
 * @since Moodle 2.9
 * @package core
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);
define('ALLOW_GET_PARAMETERS', true);

require_once('service.php');
