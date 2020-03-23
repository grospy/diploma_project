<?php
//

/**
 * Classic theme.
 *
 * @package    theme_classic
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

$plugin->version = 2019111800;
$plugin->requires = 2019111200;
$plugin->component = 'theme_classic';
$plugin->dependencies = array('theme_boost' => 2019111200);
