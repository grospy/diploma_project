<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Coverage information for the mod_forum component.
 *
 * @package    mod_forum
 * @category   phpunit
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Coverage information for the core subsystem.
 *
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
return new class extends phpunit_coverage_info {
    /** @var array The list of folders relative to the plugin root to whitelist in coverage generation. */
    protected $whitelistfolders = [
        'classes',
        'externallib.php',
    ];

    /** @var array The list of files relative to the plugin root to whitelist in coverage generation. */
    protected $whitelistfiles = [];

    /** @var array The list of folders relative to the plugin root to excludelist in coverage generation. */
    protected $excludelistfolders = [];

    /** @var array The list of files relative to the plugin root to excludelist in coverage generation. */
    protected $excludelistfiles = [];
};
