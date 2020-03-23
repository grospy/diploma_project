<?php
//

/**
 * Behat message popup related steps definitions.
 *
 * @package    message_popup
 * @category   test
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../../lib/behat/behat_base.php');

/**
 * Message popup steps definitions.
 *
 * @package    message_popup
 * @category   test
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_message_popup extends behat_base {

    /**
     * Open the notification popover in the nav bar.
     *
     * @Given /^I open the notification popover$/
     */
    public function i_open_the_notification_popover() {
        $this->execute('behat_general::i_click_on',
            array("#nav-notification-popover-container [data-region='popover-region-toggle']", 'css_element'));

        $node = $this->get_selected_node('css_element',
            '#nav-notification-popover-container [data-region="popover-region-content"]');
        $this->ensure_node_is_visible($node);
    }

    /**
     * Open the message popover in the nav bar.
     *
     * @Given /^I open the message popover$/
     */
    public function i_open_the_message_popover() {
        $this->execute('behat_general::i_click_on',
            array("#nav-message-popover-container [data-region='popover-region-toggle']", 'css_element'));

        $node = $this->get_selected_node('css_element', '#nav-message-popover-container [data-region="popover-region-content"]');
        $this->ensure_node_is_visible($node);
    }
}
