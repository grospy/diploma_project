<?php
//

/**
 * Plugin administration pages are defined here.
 *
 * @package     tool_policy
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Do nothing if we are not set as the site policies handler.
if (empty($CFG->sitepolicyhandler) || $CFG->sitepolicyhandler !== 'tool_policy') {
    return;
}

$managecaps = [
    'tool/policy:managedocs',
    'tool/policy:viewacceptances',
];

if ($hassiteconfig || has_any_capability($managecaps, context_system::instance())) {

    $ADMIN->add('privacy', new admin_externalpage(
        'tool_policy_managedocs',
        new lang_string('managepolicies', 'tool_policy'),
        new moodle_url('/admin/tool/policy/managedocs.php'),
        ['tool/policy:managedocs', 'tool/policy:viewacceptances']
    ));
    $ADMIN->add('privacy', new admin_externalpage(
        'tool_policy_acceptances',
        new lang_string('useracceptances', 'tool_policy'),
        new moodle_url('/admin/tool/policy/acceptances.php'),
        ['tool/policy:viewacceptances']
    ));
}
