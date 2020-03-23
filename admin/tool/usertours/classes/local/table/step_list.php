<?php
//

/**
 * Table to show the list of steps in a tour.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\local\table;

defined('MOODLE_INTERNAL') || die();

use tool_usertours\helper;
use tool_usertours\tour;
use tool_usertours\step;

require_once($CFG->libdir . '/tablelib.php');

/**
 * Table to show the list of steps in a tour.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class step_list extends \flexible_table {

    /**
     * @var     int     $tourid     The id of the tour.
     */
    protected $tourid;

    /**
     * Construct the table for the specified tour ID.
     *
     * @param   int     $tourid     The id of the tour.
     */
    public function __construct($tourid) {
        parent::__construct('steps');
        $this->tourid = $tourid;

        $baseurl = new \moodle_url('/tool/usertours/configure.php', array(
                'id' => $tourid,
            ));
        $this->define_baseurl($baseurl);

        // Column definition.
        $this->define_columns(array(
            'title',
            'content',
            'target',
            'actions',
        ));

        $this->define_headers(array(
            get_string('title',   'tool_usertours'),
            get_string('content', 'tool_usertours'),
            get_string('target',  'tool_usertours'),
            get_string('actions', 'tool_usertours'),
        ));

        $this->set_attribute('class', 'admintable generaltable steptable');
        $this->setup();
    }

    /**
     * Format the current row's title column.
     *
     * @param   step    $step       The step for this row.
     * @return  string
     */
    protected function col_title(step $step) {
        global $OUTPUT;
        return $OUTPUT->render(helper::render_stepname_inplace_editable($step));
    }

    /**
     * Format the current row's content column.
     *
     * @param   step    $step       The step for this row.
     * @return  string
     */
    protected function col_content(step $step) {
        return format_text(step::get_string_from_input($step->get_content()), FORMAT_HTML);
    }

    /**
     * Format the current row's target column.
     *
     * @param   step    $step       The step for this row.
     * @return  string
     */
    protected function col_target(step $step) {
        return $step->get_target()->get_displayname();
    }

    /**
     * Format the current row's actions column.
     *
     * @param   step    $step       The step for this row.
     * @return  string
     */
    protected function col_actions(step $step) {
        $actions = [];

        if ($step->is_first_step()) {
            $actions[] = helper::get_filler_icon();
        } else {
            $actions[] = helper::format_icon_link($step->get_moveup_link(), 't/up', get_string('movestepup', 'tool_usertours'));
        }

        if ($step->is_last_step()) {
            $actions[] = helper::get_filler_icon();
        } else {
            $actions[] = helper::format_icon_link($step->get_movedown_link(), 't/down',
                    get_string('movestepdown', 'tool_usertours'));
        }

        $actions[] = helper::format_icon_link($step->get_edit_link(), 't/edit', get_string('edit'));

        $actions[] = helper::format_icon_link($step->get_delete_link(), 't/delete', get_string('delete'), 'moodle', [
            'data-action'   => 'delete',
            'data-id'       => $step->get_id(),
        ]);

        return implode('&nbsp;', $actions);
    }
}
