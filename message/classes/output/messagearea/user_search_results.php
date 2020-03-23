<?php
//

/**
 * Contains class used to display user search results.
 *
 * TODO: This file should be removed once the related web services go through final deprecation.
 * Followup: MDL-63261
 *
 * @package   core_message
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message\output\messagearea;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;

/**
 * Class used to display user search results.
 *
 * @package   core_message
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_search_results implements templatable, renderable {

    /**
     * @var array The list of contacts.
     */
    public $contacts;

    /**
     * @var array The list of courses.
     */
    public $courses;

    /**
     * @var array The list of non-contacts.
     */
    public $noncontacts;

    /**
     * Constructor.
     *
     * @param array $contacts list of contacts.
     * @param array $courses list of courses.
     * @param array $noncontacts list of nonconcat users.
     */
    public function __construct($contacts, $courses = array(), $noncontacts = array()) {
        $this->contacts = $contacts;
        $this->courses = $courses;
        $this->noncontacts = $noncontacts;
    }

    public function export_for_template(\renderer_base $output) {
        // Set the defaults for the data we are going to export.
        $data = new \stdClass();
        $data->hascontacts = false;
        $data->contacts = array();
        $data->hascourses = false;
        $data->courses = array();
        $data->hasnoncontacts = false;
        $data->noncontacts = array();

        // Check if there are any contacts.
        if (!empty($this->contacts)) {
            $data->hascontacts = true;
            foreach ($this->contacts as $contact) {
                $contact = new contact($contact);
                $data->contacts[] = $contact->export_for_template($output);
            }
        }

        // Check if there are any courses.
        if (!empty($this->courses)) {
            $data->hascourses = true;
            $data->courses = [];
            foreach ($this->courses as $course) {
                $coursecontext = \context_course::instance($course->id);
                $course->shortname = external_format_string($course->shortname, $coursecontext->id, true);
                $course->fullname = external_format_string($course->fullname, $coursecontext->id, true);
                $data->courses[] = $course;
            }
        }

        // Check if there are any non-contacts.
        if (!empty($this->noncontacts)) {
            $data->hasnoncontacts = true;
            foreach ($this->noncontacts as $noncontact) {
                $noncontact = new contact($noncontact);
                $data->noncontacts[] = $noncontact->export_for_template($output);
            }
        }

        return $data;
    }
}