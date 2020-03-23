<?php
//

/**
 * Contains event class for displaying a calendar event's subscription.
 *
 * @package   core_calendar
 * @copyright 2017 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\external;

defined('MOODLE_INTERNAL') || die();

use \core\external\exporter;
use \core_calendar\local\event\entities\event_interface;

/**
 * Class for displaying a calendar event's subscription.
 *
 * @package   core_calendar
 * @copyright 2017 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_subscription_exporter extends exporter {

    /**
     * Constructor.
     *
     * @param event_interface $event
     */
    public function __construct(event_interface $event) {
        global $CFG;

        $data = new \stdClass();
        $data->displayeventsource = false;
        if ($event->get_subscription()) {
            $subscription = calendar_get_subscription($event->get_subscription()->get('id'));
            if (!empty($subscription) && $CFG->calendar_showicalsource) {
                $data->displayeventsource = true;
                if (!empty($subscription->url)) {
                    $data->subscriptionurl = $subscription->url;
                }
                $data->subscriptionname = $subscription->name;
            }
        }

        parent::__construct($data);
    }

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'displayeventsource' => [
                'type' => PARAM_BOOL
            ],
            'subscriptionname' => [
                'type' => PARAM_RAW,
                'optional' => true
            ],
            'subscriptionurl' => [
                'type' => PARAM_URL,
                'optional' => true
            ],
        ];
    }
}
