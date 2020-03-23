<?php
//

/**
 * Behat course-related step definition overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../course/tests/behat/behat_course.php');

/**
 * Course-related step definition overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_theme_classic_behat_course extends behat_course {

    /**
     * Go to the course participants.
     */
    public function i_navigate_to_course_participants() {
        $coursestr = behat_context_helper::escape(get_string('courses'));
        $mycoursestr = behat_context_helper::escape(get_string('mycourses'));
        $xpath = "//div[contains(@class,'block')]//li[p/*[string(.)=$coursestr or string(.)=$mycoursestr]]";
        $this->execute('behat_general::i_click_on_in_the', [get_string('participants'), 'link', $xpath, 'xpath_element']);
    }
}
