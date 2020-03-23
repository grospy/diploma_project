<?php
//

/**
 * Behat steps definitions for drag and drop markers.
 *
 * @package   qtype_ddmarker
 * @category  test
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../../lib/behat/behat_base.php');

/**
 * Steps definitions related with the drag and drop markers question type.
 *
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_qtype_ddmarker extends behat_base {

    /**
     * Get the xpath for a given drag item.
     * @param string $dragitem the text of the item to drag.
     * @return string the xpath expression.
     */
    protected function marker_xpath($marker, $item = 0) {
        return '//span[contains(@class, " dragitem ") and contains(@class, " item' . $item .
                '") and span[@class = "markertext" and contains(normalize-space(.), "' .
                $this->escape($marker) . '")]]';
    }

    protected function parse_marker_name($marker) {
        $item = 0;
        if (preg_match('~,(\d+)$~', $marker, $matches)) {
            $item = $matches[1];
            $marker = substr($marker, 0, -1 - strlen($item));
        }
        return array($marker, $item);
    }

    /**
     * Drag the drag item with the given text to the given space.
     *
     * @param string $marker the marker to drag. The label, optionally followed by ,<instance number> (int) if relevant.
     * @param string $coordinates the position to drag the marker to, 'x,y'.
     *
     * @Given /^I drag "(?P<marker>[^"]*)" to "(?P<coordinates>\d+,\d+)" in the drag and drop markers question$/
     */
    public function i_drag_to_in_the_drag_and_drop_markers_question($marker, $coordinates) {
        list($marker, $item) = $this->parse_marker_name($marker);
        list($x, $y) = explode(',', $coordinates);

        // This is a bit nasty, but Behat (indeed Selenium) will only drag on
        // DOM node so that its centre is over the centre of anothe DOM node.
        // Therefore to make it drag to the specified place, we have to add
        // a target div.
        $session = $this->getSession();
        $session->executeScript("
                (function() {
                    if (document.getElementById('target-{$x}-{$y}')) {
                        return;
                    }
                    var image = document.querySelector('.dropbackground');
                    var target = document.createElement('div');
                    target.setAttribute('id', 'target-{$x}-{$y}');
                    var container = document.querySelector('.droparea');
                    container.style.setProperty('position', 'relative');
                    container.insertBefore(target, image);
                    var xadjusted = {$x} + (container.offsetWidth - image.offsetWidth) / 2;
                    var yadjusted = {$y} + (container.offsetHeight - image.offsetHeight) / 2;
                    target.style.setProperty('position', 'absolute');
                    target.style.setProperty('left', xadjusted + 'px');
                    target.style.setProperty('top', yadjusted + 'px');
                    target.style.setProperty('width', '1px');
                    target.style.setProperty('height', '1px');
                }())");

        $generalcontext = behat_context_helper::get('behat_general');
        $generalcontext->i_drag_and_i_drop_it_in($this->marker_xpath($marker, $item),
                'xpath_element', "#target-{$x}-{$y}", 'css_element');
    }

    /**
     * Type some characters while focussed on a given drop box.
     *
     * @param string $direction the direction key to press.
     * @param int $
     * @param string $marker the marker to drag. The label, optionally followed by ,<instance number> (int) if relevant.
     *
     * @Given /^I type "(?P<direction>up|down|left|right)" "(?P<repeats>\d+)" times on marker "(?P<marker>[^"]*)" in the drag and drop markers question$/
     */
    public function i_type_on_marker_in_the_drag_and_drop_markers_question($direction, $repeats, $marker) {
        $keycodes = array(
            'up'    => chr(38),
            'down'  => chr(40),
            'left'  => chr(37),
            'right' => chr(39),
        );
        list($marker, $item) = $this->parse_marker_name($marker);
        $node = $this->get_selected_node('xpath_element', $this->marker_xpath($marker, $item));
        $this->ensure_node_is_visible($node);
        for ($i = 0; $i < $repeats; $i++) {
            $node->keyDown($keycodes[$direction]);
            $node->keyPress($keycodes[$direction]);
            $node->keyUp($keycodes[$direction]);
        }
    }
}
