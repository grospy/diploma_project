<?php
//

/**
 * Step definitions related to blocks overrides for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../blocks/tests/behat/behat_blocks.php');

/**
 * Blocks management step definitions for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_theme_classic_behat_blocks extends behat_blocks {

    /**
     * Adds the selected block. Editing mode must be previously enabled.
     *
     * @param string $blockname
     * @return void
     */
    public function i_add_the_block($blockname) {
        $this->execute('behat_forms::i_set_the_field_to',
                array("bui_addblock", $this->escape($blockname))
        );

        // If we are running without javascript we need to submit the form.
        if (!$this->running_javascript()) {
            $this->execute('behat_general::i_click_on_in_the',
                    array(get_string('go'), "button", "#add_block", "css_element")
            );
        }
    }

    /**
     * Ensures that block can be added to the page, but does not add it.
     *
     * @param string $blockname
     * @return void
     */
    public function the_add_block_selector_should_contain_block($blockname) {
        $this->execute('behat_forms::the_select_box_should_contain', [get_string('addblock'), $blockname]);
    }

    /**
     * Ensures that block cannot be added to the page.
     *
     * @param string $blockname
     * @return void
     */
    public function the_add_block_selector_should_not_contain_block($blockname) {
        $this->execute('behat_forms::the_select_box_should_not_contain', [get_string('addblock'), $blockname]);
    }
}
