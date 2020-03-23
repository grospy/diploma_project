<?php
//

/**
 * Step definitions related to mod_forum overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../mod/forum/tests/behat/behat_mod_forum.php');

/**
 * Step definitions related to mod_forum overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_theme_classic_behat_mod_forum extends behat_mod_forum {

    /**
     * Checks if the user can subscribe to the forum.
     */
    public function i_can_subscribe_to_this_forum() {
        $this->execute('behat_general::assert_page_contains_text', [get_string('subscribe', 'mod_forum')]);
    }

    /**
     * Checks if the user can unsubscribe from the forum.
     */
    public function i_can_unsubscribe_from_this_forum() {
        $this->execute('behat_general::assert_page_contains_text', [get_string('unsubscribe', 'mod_forum')]);
    }

    /**
     * Subscribes to the forum.
     */
    public function i_subscribe_to_this_forum() {
        $this->execute('behat_general::click_link', [get_string('subscribe', 'mod_forum')]);
    }

    /**
     * Unsubscribes from the forum.
     */
    public function i_unsubscribe_from_this_forum() {
        $this->execute('behat_general::click_link', [get_string('unsubscribe', 'mod_forum')]);
    }
}
