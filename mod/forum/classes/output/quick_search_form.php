<?php
//

/**
 * Quick search form renderable.
 *
 * @package    mod_forum
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\output;
defined('MOODLE_INTERNAL') || die();

use help_icon;
use moodle_url;
use renderable;
use renderer_base;
use templatable;

/**
 * Quick search form renderable class.
 *
 * @package    mod_forum
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quick_search_form implements renderable, templatable {

    /** @var int The course ID. */
    protected $courseid;
    /** @var string Current query. */
    protected $query;
    /** @var moodle_url The form action URL. */
    protected $actionurl;
    /** @var help_icon The help icon. */
    protected $helpicon;

    /**
     * Constructor.
     *
     * @param int $courseid The course ID.
     * @param string $query The current query.
     */
    public function __construct($courseid, $query = '') {
        $this->courseid = $courseid;
        $this->query = $query;
        $this->actionurl = new moodle_url('/mod/forum/search.php');
        $this->helpicon = new help_icon('search', 'core');
    }

    public function export_for_template(renderer_base $output) {
        $data = [
            'actionurl' => $this->actionurl->out(false),
            'courseid' => $this->courseid,
            'query' => $this->query,
            'helpicon' => $this->helpicon->export_for_template($output),
        ];
        return $data;
    }

}
