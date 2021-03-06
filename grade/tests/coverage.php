<?php
//

/**
 * Coverage information for the grades component.
 *
 * @package    core_grades
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Coverage information for the core_grades subsystem.
 *
 * @package    core_grades
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
return new class extends phpunit_coverage_info {
    // Array The list of folders relative to the plugin root to whitelist in coverage generation.
    protected $whitelistfolders = [
        'classes',
    ];
};
