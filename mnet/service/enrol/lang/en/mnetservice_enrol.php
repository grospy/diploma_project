<?php

//

/**
 * @package    mnetservice
 * @subpackage enrolment
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['availablecourseson'] = 'Available courses on {$a}';
$string['availablecoursesonnone'] = 'Remote host <a href="{$a->hosturl}">{$a->hostname}</a> does not offer any courses for our users.';
$string['clientname'] = 'Remote enrolments client';
$string['clientname_help'] = 'This tool allows you to enrol and unenrol your local users on remote hosts that allow you to do so via the \'MNet remote enrolments\' plugin.';
$string['editenrolments'] = 'Edit enrolments';
$string['hostappname'] = 'Application';
$string['hostname'] = 'Host name';
$string['hosturl'] = 'Remote host URL';
$string['nopublishers'] = 'No remote peers available.';
$string['noroamingusers'] = 'Users require the capability \'{$a}\' in the system context to be enrolled to remote courses, however there are currently no users with this capability. Click the continue button to assign the required capability to one or more roles on your site.';
$string['otherenrolledusers'] = 'Other enrolled users';
$string['pluginname'] = 'Remote enrolment service';
$string['refetch'] = 'Re-fetch up to date state from remote hosts';
$string['privacy:metadata:mnetservice_enrol_enrolments'] = 'Remote enrolment service';
$string['privacy:metadata:mnetservice_enrol_enrolments:enroltime'] = 'The time when the enrolment was modified';
$string['privacy:metadata:mnetservice_enrol_enrolments:enroltype'] = 'The enrolment type on the remote server used to enrol the user in their course';
$string['privacy:metadata:mnetservice_enrol_enrolments:hostid'] = 'The ID of the remote MNet host';
$string['privacy:metadata:mnetservice_enrol_enrolments:remotecourseid'] = 'The ID of the course on the remote server';
$string['privacy:metadata:mnetservice_enrol_enrolments:rolename'] = 'The name of role on the remote server';
$string['privacy:metadata:mnetservice_enrol_enrolments:tableexplanation'] = 'The Remote enrolment service stores information about enrolments of local users in courses on remote hosts.';
$string['privacy:metadata:mnetservice_enrol_enrolments:userid'] = 'The ID of the local user on this server';
