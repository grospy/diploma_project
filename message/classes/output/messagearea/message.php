<?php
//

/**
 * Contains class used to prepare a message for display.
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

use renderable;
use templatable;

/**
 * Class to prepare a message for display.
 *
 * @package   core_message
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message implements templatable, renderable {

    /**
     * @var int The message id.
     */
    public $id;

    /**
     * @var int The current userid.
     */
    public $currentuserid;

    /**
     * @var int The userid to.
     */
    public $useridto;

    /**
     * @var int The userid from.
     */
    public $useridfrom;

    /**
     * @var string The message text.
     */
    public $text;

    /**
     * @var bool Are we displaying the time?
     */
    public $displayblocktime;

    /**
     * @var int The time created of the message.
     */
    public $timecreated;

    /**
     * @var int The time the message was read.
     */
    public $timeread;

    /**
     * Constructor.
     *
     * @param \stdClass $message
     */
    public function __construct($message) {
        $this->id = $message->id;
        $this->currentuserid = $message->currentuserid;
        $this->useridto = $message->useridto;
        $this->useridfrom = $message->useridfrom;
        $this->text = $message->text;
        $this->displayblocktime = $message->displayblocktime;
        $this->timecreated = $message->timecreated;
        $this->timeread = $message->timeread;
    }

    public function export_for_template(\renderer_base $output) {
        $message = new \stdClass();
        $message->id = $this->id;
        $message->useridto = $this->useridto;
        $message->useridfrom = $this->useridfrom;
        $message->text = $this->text;
        $message->displayblocktime = $this->displayblocktime;
        $message->blocktime = userdate($this->timecreated, get_string('strftimedaydate'));
        $message->position = 'left';
        if ($this->currentuserid == $this->useridfrom) {
            $message->position = 'right';
        }
        $message->timesent = userdate($this->timecreated, get_string('strftimetime'));
        $message->timecreated = $this->timecreated;
        $message->isread = !empty($this->timeread) ? 1 : 0;

        return $message;
    }
}
