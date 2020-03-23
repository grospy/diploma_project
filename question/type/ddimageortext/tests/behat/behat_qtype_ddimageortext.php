<?php
//

/**
 * Behat steps definitions for drag and drop onto image.
 *
 * @package   qtype_ddimageortext
 * @category  test
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../../lib/behat/behat_base.php');

/**
 * Steps definitions related with the drag and drop onto image question type.
 *
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_qtype_ddimageortext extends behat_base {

    /**
     * Get the xpath for a given drag item.
     * @param string $dragitem the text of the item to drag.
     * @return string the xpath expression.
     */
    protected function drag_xpath($dragitem) {
        return '//div[contains(concat(" ", @class, " "), " drag ") and ' .
                'contains(normalize-space(.), "' . $this->escape($dragitem) . '")]';
    }

    /**
     * Get the xpath for a given drop box.
     * @param string $placenumber the number of the drop box.
     * @return string the xpath expression.
     */
    protected function drop_xpath($placenumber) {
        return '//div[contains(concat(" ", @class, " "), " dropzone ") and ' .
                'contains(concat(" ", @class, " "), " place' . $placenumber . ' ")]';
    }

    /**
     * Drag the drag item with the given text to the given space.
     *
     * @param string $dragitem the text of the item to drag.
     * @param int $placenumber the number of the place to drop into.
     *
     * @Given /^I drag "(?P<drag_item>[^"]*)" to place "(?P<place_number>\d+)" in the drag and drop onto image question$/
     */
    public function i_drag_to_place_in_the_drag_and_drop_onto_image_question($dragitem, $placenumber) {
        $generalcontext = behat_context_helper::get('behat_general');
        $generalcontext->i_drag_and_i_drop_it_in($this->drag_xpath($dragitem),
                'xpath_element', $this->drop_xpath($placenumber), 'xpath_element');
    }

    /**
     * Type some characters while focussed on a given drop box.
     *
     * @param string $keys the characters to type.
     * @param int $placenumber the number of the place to drop into.
     *
     * @Given /^I type "(?P<keys>[^"]*)" on place "(?P<place_number>\d+)" in the drag and drop onto image question$/
     */
    public function i_type_on_place_in_the_drag_and_drop_onto_image_question($keys, $placenumber) {
        $node = $this->get_selected_node('xpath_element', $this->drop_xpath($placenumber));
        $this->ensure_node_is_visible($node);
        foreach (str_split($keys) as $key) {
            $node->keyDown($key);
            $node->keyPress($key);
            $node->keyUp($key);
        }
    }
}
