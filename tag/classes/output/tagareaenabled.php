<?php
//

/**
 * Contains class core_tag\output\tagareaenabled
 *
 * @package   core_tag
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\output;

use context_system;

/**
 * Class to display tag area enabled control
 *
 * @package   core_tag
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tagareaenabled extends \core\output\inplace_editable {

    /**
     * Constructor.
     *
     * @param \stdClass $tagarea
     */
    public function __construct($tagarea) {
        $editable = has_capability('moodle/tag:manage', context_system::instance());
        $value = $tagarea->enabled ? 1 : 0;

        parent::__construct('core_tag', 'tagareaenable', $tagarea->id, $editable, '', $value);
        $this->set_type_toggle();
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param \renderer_base $output
     * @return \stdClass
     */
    public function export_for_template(\renderer_base $output) {
        if ($this->value) {
            $this->edithint = get_string('disable');
            $this->displayvalue = $output->pix_icon('i/hide', get_string('disable'));
        } else {
            $this->edithint = get_string('enable');
            $this->displayvalue = $output->pix_icon('i/show', get_string('enable'));
        }

        return parent::export_for_template($output);
    }

    /**
     * Updates the value in database and returns itself, called from inplace_editable callback
     *
     * @param int $itemid
     * @param mixed $newvalue
     * @return \self
     */
    public static function update($itemid, $newvalue) {
        global $DB;
        require_capability('moodle/tag:manage', context_system::instance());
        $tagarea = $DB->get_record('tag_area', array('id' => $itemid), '*', MUST_EXIST);
        $newvalue = $newvalue ? 1 : 0;
        $data = array('enabled' => $newvalue);
        \core_tag_area::update($tagarea, $data);
        $tagarea->enabled = $newvalue;
        $tmpl = new self($tagarea);
        return $tmpl;
    }
}
