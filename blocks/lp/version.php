<?php
//

/**
 * Block LP version file.
 *
 * @package    block_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;
$plugin->requires  = 2019111200;
$plugin->component = 'block_lp';
$plugin->dependencies = array(
    'tool_lp' => ANY_VERSION
);
