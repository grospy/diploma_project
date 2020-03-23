<?php
//

/**
 * Settings page.
 *
 * @package   tool_usertours
 * @copyright 2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$capabilities = [
    'tool/usertours:managetours',
];
if ($hassiteconfig || has_any_capability($capabilities, context_system::instance())) {
    $ADMIN->add(
        'appearance',
        new admin_externalpage(
            'tool_usertours/tours',
            get_string('usertours', 'tool_usertours'),
            new moodle_url('/admin/tool/usertours/configure.php'),
            'tool/usertours:managetours'
        )
    );
}
