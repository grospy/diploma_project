<?php
//

/**
 * This file contains form for bulk changing user enrolments.
 *
 * @package    enrol_manual
 * @copyright  2011 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->dirroot/enrol/bulkchange_forms.php");

/**
 * The form to collect required information when bulk editing users enrolments.
 *
 * @copyright 2011 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_manual_editselectedusers_form extends enrol_bulk_enrolment_change_form {}

/**
 * The form to confirm the intention to bulk delete users enrolments.
 *
 * @copyright 2011 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_manual_deleteselectedusers_form extends enrol_bulk_enrolment_confirm_form {}
