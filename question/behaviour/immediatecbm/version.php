<?php
//

/**
 * Version information for the calculated question type.
 *
 * @package    qbehaviour
 * @subpackage immediatecbm
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'qbehaviour_immediatecbm';
$plugin->version   = 2019111800;

$plugin->requires  = 2019111200;
$plugin->dependencies = array(
    'qbehaviour_immediatefeedback' => 2019111200,
    'qbehaviour_deferredcbm'       => 2019111200
);

$plugin->maturity  = MATURITY_STABLE;
