<?php
//

/**
 * User button. Adapted from core_select_user_button.
 *
 * @package    gradereport_history
 * @copyright  2013 NetSpot Pty Ltd (https://www.netspot.com.au)
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_history\output;

defined('MOODLE_INTERNAL') || die;

/**
 * A button that is used to select users for a form.
 *
 * @since      Moodle 2.8
 * @package    gradereport_history
 * @copyright  2013 NetSpot Pty Ltd (https://www.netspot.com.au)
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_button extends \single_button implements \renderable {
    /**
     * Initialises the new select_user_button.
     *
     * @param \moodle_url $url
     * @param string $label The text to display in the button
     * @param string $method Either post or get
     */
    public function __construct(\moodle_url $url, $label, $method = 'post') {
        parent::__construct($url, $label, $method);
        $this->class = 'singlebutton selectusersbutton gradereport_history_plugin';
        $this->formid = \html_writer::random_id('selectusersbutton');
    }
}
