<?php

//

/**
 * Scheduled allocator that internally executes the random one
 *
 * @package     workshopallocation_scheduled
 * @subpackage  mod_workshop
 * @copyright   2012 David Mudrak <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component  = 'workshopallocation_scheduled';
$plugin->version    = 2019111800;
$plugin->requires   = 2019111200;
$plugin->dependencies = array(
    'workshopallocation_random'  => 2019111200,
);
$plugin->maturity   = MATURITY_STABLE;
