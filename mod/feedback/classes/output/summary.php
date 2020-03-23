<?php
//

/**
 * Contains class mod_feedback\output\summary
 *
 * @package   mod_feedback
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_feedback\output;

use renderable;
use templatable;
use renderer_base;
use stdClass;
use moodle_url;
use mod_feedback_structure;

/**
 * Class to help display feedback summary
 *
 * @package   mod_feedback
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class summary implements renderable, templatable {

    /** @var mod_feedback_structure */
    protected $feedbackstructure;

    /** @var int */
    protected $mygroupid;

    /** @var bool  */
    protected $extradetails;

    /**
     * Constructor.
     *
     * @param mod_feedback_structure $feedbackstructure
     * @param int $mygroupid currently selected group
     * @param bool $extradetails display additional details (time open, time closed)
     */
    public function __construct($feedbackstructure, $mygroupid = false, $extradetails = false) {
        $this->feedbackstructure = $feedbackstructure;
        $this->mygroupid = $mygroupid;
        $this->extradetails = $extradetails;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $r = new stdClass();
        $r->completedcount = $this->feedbackstructure->count_completed_responses($this->mygroupid);
        $r->itemscount = count($this->feedbackstructure->get_items(true));
        if ($this->extradetails && ($timeopen = $this->feedbackstructure->get_feedback()->timeopen)) {
            $r->timeopen = userdate($timeopen);
        }
        if ($this->extradetails && ($timeclose = $this->feedbackstructure->get_feedback()->timeclose)) {
            $r->timeclose = userdate($timeclose);
        }

        return $r;
    }
}
