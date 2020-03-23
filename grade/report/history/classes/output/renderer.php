<?php
//

/**
 * Renderer for history grade report.
 *
 * @package    gradereport_history
 * @copyright  2013 NetSpot Pty Ltd (https://www.netspot.com.au)
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_history\output;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderer for history grade report.
 *
 * @since      Moodle 2.8
 * @package    gradereport_history
 * @copyright  2013 NetSpot Pty Ltd (https://www.netspot.com.au)
 * @author     Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    /**
     * Render for the select user button.
     *
     * @param user_button $button instance of  gradereport_history_user_button to render
     *
     * @return string HTML to display
     */
    protected function render_user_button(user_button $button) {
        $data = $button->export_for_template($this);
        return $this->render_from_template('gradereport_history/user_button', $data);
    }

    /**
     * Get the html for the table.
     *
     * @param tablelog $tablelog table object.
     *
     * @return string table html
     */
    protected function render_tablelog(tablelog $tablelog) {
        $o = '';
        ob_start();
        $tablelog->out($tablelog->pagesize, false);
        $o = ob_get_contents();
        ob_end_clean();

        return $o;
    }

}
