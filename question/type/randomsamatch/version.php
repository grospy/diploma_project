<?php
//

/**
 * Version information for the randomsamatch question type.
 *
 * @package    qtype_randomsamatch
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2019111800;
$plugin->requires = 2019111200;

$plugin->component = 'qtype_randomsamatch';

$plugin->dependencies = array(
    'qtype_match' => 2019111200,
    'qtype_shortanswer' => 2019111200,
);

$plugin->maturity  = MATURITY_STABLE;
