<?php
//

/**
 * Sends request to check web site availability.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2013 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/badgeslib.php');

require_login();
$PAGE->set_url('/badges/ajax.php');
$PAGE->set_context(context_system::instance());

// Unlock session during potentially long curl request.
\core\session\manager::write_close();

$result = badges_check_backpack_accessibility();

$outcome = new stdClass();
$outcome->code = $result;
$outcome->response = get_string('error:backpacknotavailable', 'badges') . $OUTPUT->help_icon('backpackavailability', 'badges');

echo $OUTPUT->header();
echo json_encode($outcome);

die();
