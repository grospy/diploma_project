<?php
//

/**
 * Age and location verification renderable.
 *
 * @package     core_auth
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_auth\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

require_once($CFG->libdir.'/formslib.php');

/**
 * Age and location verification renderable class.
 *
 * @copyright 2018 Mihail Geshoski <mihail@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class verify_age_location_page implements renderable, templatable {

    /** @var mform The form object */
    protected $form;

    /** @var string Error message */
    protected $errormessage;

    /**
     * Constructor
     *
     * @param mform $form The form object
     * @param string $errormessage The error message.
     */
    public function __construct($form, $errormessage = null) {
        $this->form = $form;
        $this->errormessage = $errormessage;
    }

    /**
     * Export the page data for the mustache template.
     *
     * @param renderer_base $output renderer to be used to render the page elements.
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $SITE;

        $sitename = format_string($SITE->fullname);
        $formhtml = $this->form->render();
        $error = $this->errormessage;

        $context = [
            'sitename' => $sitename,
            'formhtml' => $formhtml,
            'error'    => $error
        ];

        return $context;
    }
}
