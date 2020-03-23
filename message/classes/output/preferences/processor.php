<?php
//

/**
 * Contains processor class for displaying on message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message\output\preferences;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;

/**
 * Class to create context for one of the message processors settings on the message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class processor implements templatable, renderable {

    /**
     * @var \stdClass The message processor.
     */
    protected $processor;

    /**
     * @var \stdClass list of message preferences.
     */
    protected $preferences;

    /**
     * @var \stdClass A user.
     */
    protected $user;

    /**
     * @var string The processor type.
     */
    protected $type;

    /**
     * Constructor.
     *
     * @param \stdClass $processor
     * @param \stdClass $preferences
     * @param \stdClass $user
     * @param string $type
     */
    public function __construct($processor, $preferences, $user, $type) {
        $this->processor = $processor;
        $this->preferences = $preferences;
        $this->user = $user;
        $this->type = $type;
    }

    public function export_for_template(\renderer_base $output) {
        return [
            'userid' => $this->user->id,
            'displayname' => get_string('pluginname', 'message_'.$this->type),
            'name' => $this->type,
            'formhtml' => $this->processor->config_form($this->preferences),
        ];
    }
}
