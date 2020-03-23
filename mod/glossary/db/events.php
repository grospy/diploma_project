<?php
//

/**
 * Glossary event observer.
 *
 * @package    mod_glossary
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array(
    array (
        'eventname' => '\core\event\course_module_updated',
        'callback'  => '\mod_glossary\local\concept_cache::cm_updated',
    ),
);