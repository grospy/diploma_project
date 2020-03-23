<?php
//

/**
 * Search form renderable.
 *
 * @package    block_search_forums
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_search_forums\output;
defined('MOODLE_INTERNAL') || die();

use help_icon;
use moodle_url;
use renderable;
use renderer_base;
use templatable;

/**
 * Search form renderable class.
 *
 * @package    block_search_forums
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_form implements renderable, templatable {

    /** @var int The course ID. */
    protected $courseid;
    /** @var moodle_url The form action URL. */
    protected $actionurl;
    /** @var moodle_url The advanced search URL. */
    protected $advancedsearchurl;
    /** @var help_icon The help icon. */
    protected $helpicon;

    /**
     * Constructor.
     *
     * @param int $courseid The course ID.
     */
    public function __construct($courseid) {
        $this->courseid = $courseid;
        $this->actionurl = new moodle_url('/mod/forum/search.php');
        $this->advancedsearchurl = new moodle_url('/mod/forum/search.php', ['id' => $this->courseid]);
        $this->helpicon = new help_icon('search', 'core');
    }

    public function export_for_template(renderer_base $output) {
        $data = [
            'actionurl' => $this->actionurl->out(false),
            'courseid' => $this->courseid,
            'advancedsearchurl' => $this->advancedsearchurl->out(false),
            'helpicon' => $this->helpicon->export_for_template($output),
        ];
        return $data;
    }

}
