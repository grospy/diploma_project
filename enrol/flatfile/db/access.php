<?php
//

/**
 * Capabilities for manual enrolment plugin.
 *
 * @package    enrol_flatfile
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    /* Manage enrolments of users - requires allowmodifications enabled. */
    'enrol/flatfile:manage' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
        )
    ),

    /* Unenrol anybody (including self) - requires allowmodifications enabled */
    'enrol/flatfile:unenrol' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
        )
    ),
);
