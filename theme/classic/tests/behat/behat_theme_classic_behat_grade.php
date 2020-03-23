<?php
//

/**
 * Behat grade related step definition overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../grade/tests/behat/behat_grade.php');

use Behat\Gherkin\Node\TableNode as TableNode;

/**
 * Behat grade overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_theme_classic_behat_grade extends behat_grade {

    /**
     * Navigates to the course gradebook and selects a specified item from the grade navigation tabs.
     *
     * @param string $gradepath
     */
    public function i_navigate_to_in_the_course_gradebook($gradepath) {
        // If we are not on one of the gradebook pages already, follow "Grades" link in the navigation block.
        $xpath = '//div[contains(@class,\'grade-navigation\')]';
        if (!$this->getSession()->getPage()->findAll('xpath', $xpath)) {
            $this->execute("behat_general::i_click_on_in_the", array(get_string('grades'), 'link',
                    get_string('pluginname', 'block_navigation'), 'block'));
        }

        $this->select_in_gradebook_tabs($gradepath);
    }
}
