<?php

//

/**
 * Strings for component 'workshopallocation_random', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package    workshopallocation
 * @subpackage random
 * @copyright  2009 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addselfassessment'] = 'Add self-assessments';
$string['allocationaddeddetail'] = 'New assessment to be done: <strong>{$a->reviewername}</strong> is reviewer of <strong>{$a->authorname}</strong>';
$string['allocationdeallocategraded'] = 'Unable to deallocate already graded assessment: reviewer <strong>{$a->reviewername}</strong>, submission author <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'Reused assessment: <strong>{$a->reviewername}</strong> kept as reviewer of <strong>{$a->authorname}</strong>';
$string['allocationsettings'] = 'Allocation settings';
$string['assessmentdeleteddetail'] = 'Assessment deallocated: <strong>{$a->reviewername}</strong> is no longer reviewer of <strong>{$a->authorname}</strong>';
$string['assesswosubmission'] = 'Participants can assess without having submitted anything';
$string['confignumofreviews'] = 'Default number of submissions to be randomly allocated';
$string['excludesamegroup'] = 'Prevent reviews by peers from the same group';
$string['noallocationtoadd'] = 'No allocations to add';
$string['nogroupusers'] = '<p>Warning: If the workshop is in \'visible groups\' mode or \'separate groups\' mode, then users MUST be part of at least one group to have peer-assessments allocated to them by this tool. Non-grouped users can still be given new self-assessments or have existing assessments removed.</p>
<p>These users are currently not in a group: {$a}</p>';
$string['numofdeallocatedassessment'] = 'Deallocating {$a} assessment(s)';
$string['numofrandomlyallocatedsubmissions'] = 'Randomly assigning {$a} allocations';
$string['numofreviews'] = 'Number of reviews';
$string['numofselfallocatedsubmissions'] = 'Self-allocating {$a} submission(s)';
$string['numperauthor'] = 'per submission';
$string['numperreviewer'] = 'per reviewer';
$string['pluginname'] = 'Random allocation';
$string['privacy:metadata'] = 'The Random allocation plugin does not store any personal data. Actual personal data about who is going to assess whom are stored by the Workshop module itself and they form basis for exporting the assessments details.';
$string['randomallocationdone'] = 'Random allocation done';
$string['resultnomorepeers'] = 'No more peers available';
$string['resultnomorepeersingroup'] = 'No more peers available in this separate group';
$string['resultnotenoughpeers'] = 'Not enough peers available';
$string['resultnumperauthor'] = 'Trying to allocate {$a} review(s) per author';
$string['resultnumperreviewer'] = 'Trying to allocate {$a} review(s) per reviewer';
$string['removecurrentallocations'] = 'Remove current allocations';
$string['stats'] = 'Current allocation statistics';
