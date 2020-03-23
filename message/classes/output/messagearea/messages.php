<?php
//

/**
 * Contains class used to prepare the messages for display.
 *
 * TODO: This file should be removed once the related web services go through final deprecation.
 * Followup: MDL-63261
 *
 * @package   core_message
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message\output\messagearea;

defined('MOODLE_INTERNAL') || die();

use core_message\api;
use renderable;
use templatable;

/**
 * Class to prepare the messages for display.
 *
 * @package   core_message
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class messages implements templatable, renderable {

    /**
     * @var array The messages.
     */
    public $messages;

    /**
     * @var int The current user id.
     */
    public $currentuserid;

    /**
     * @var int The other user id.
     */
    public $otheruserid;

    /**
     * @var \stdClass The other user.
     */
    public $otheruser;

    /**
     * Constructor.
     *
     * @param int $currentuserid The current user we are wanting to view messages for
     * @param int $otheruserid The other user we are wanting to view messages for
     * @param array $messages
     */
    public function __construct($currentuserid, $otheruserid, $messages) {
        $ufields = 'id, ' . get_all_user_name_fields(true) . ', lastaccess';

        $this->currentuserid = $currentuserid;
        if ($otheruserid) {
            $this->otheruserid = $otheruserid;
            $this->otheruser = \core_user::get_user($otheruserid, $ufields, MUST_EXIST);
        }
        $this->messages = $messages;
    }

    public function export_for_template(\renderer_base $output) {
        global $USER;

        $data = new \stdClass();
        $data->iscurrentuser = $USER->id == $this->currentuserid;
        $data->currentuserid = $this->currentuserid;
        if ($this->otheruserid) {
            $data->otheruserid = $this->otheruserid;
            $data->otheruserfullname = fullname($this->otheruser);
        }
        $data->isonline = null;
        if ($this->otheruserid) {
            if (\core_message\helper::show_online_status($this->otheruser)) {
                $data->isonline = \core_message\helper::is_online($this->otheruser->lastaccess);
            }
        }
        $data->showonlinestatus = is_null($data->isonline) ? false : true;

        $data->messages = array();
        foreach ($this->messages as $message) {
            $message = new message($message);
            $data->messages[] = $message->export_for_template($output);
        }

        $blockeduserid = $this->otheruserid ?? $USER->id;
        $data->isblocked = api::is_blocked($this->currentuserid, $blockeduserid);

        return $data;
    }
}
