<?php
//

/**
 * Version information for the simple calculated question type.
 *
 * @package    qtype
 * @subpackage calculatedsimple
 * @copyright  1999 onwards Martin Dougiamas {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'qtype_calculatedsimple';
$plugin->version   = 2019111800;

$plugin->requires  = 2019111200;
$plugin->dependencies = array(
    'qtype_numerical'  => 2019111200,
    'qtype_calculated' => 2019111200,
);

$plugin->maturity  = MATURITY_STABLE;
