<?php

//

/**
 * MOODLE VERSION INFORMATION
 *
 * This file defines the current version of the core Moodle code being used.
 * This is compared against the values stored in the database to determine
 * whether upgrades should be performed (see lib/db/*.php)
 *
 * @package    core
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$version  = 2019111802.00;              // 20191118      = branching date YYYYMMDD - do not modify!
                                        //         RR    = release increments - 00 in DEV branches.
                                        //           .XX = incremental changes.
$release  = '3.8.2 (Build: 20200309)'; // Human-friendly version name
$branch   = '38';                       // This version's branch.
$maturity = MATURITY_STABLE;             // This version's maturity level.
