<?php
//

/**
 * Coverage information for the core_grading subsystem.
 *
 * @package    core_grading
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Coverage information for the core_grading subsystem.
 *
 * @package    core_grading
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
return new class extends phpunit_coverage_info {
    // Array The list of folders relative to the plugin root to whitelist in coverage generation.
    protected $whitelistfolders = [
        'classes',
        'tests/generator',
    ];
};
