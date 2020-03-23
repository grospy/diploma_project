<?php
//

/**
 * EditPDF event handler definition.
 *
 * @package assignfeedback_editpdf
 * @category event
 * @copyright 2016 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// List of observers.
$observers = array(
    array(
        'eventname'   => '\mod_assign\event\submission_created',
        'callback'    => '\assignfeedback_editpdf\event\observer::submission_created',
    ),
    array(
        'eventname'   => '\mod_assign\event\submission_updated',
        'callback'    => '\assignfeedback_editpdf\event\observer::submission_updated',
    ),
);
