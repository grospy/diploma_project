<?php
//

/**
 * Contains class core_tag\output\tagname
 *
 * @package   core_tag
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\output;

use context_system;
use lang_string;
use html_writer;
use core_tag_tag;

/**
 * Class to preapare a tag name for display.
 *
 * @package   core_tag
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tagname extends \core\output\inplace_editable {

    /**
     * Constructor.
     *
     * @param \stdClass|core_tag_tag $tag
     */
    public function __construct($tag) {
        $editable = has_capability('moodle/tag:manage', context_system::instance());
        $edithint = new lang_string('editname', 'core_tag');
        $editlabel = new lang_string('newnamefor', 'core_tag', $tag->rawname);
        $value = $tag->rawname;
        $displayvalue = html_writer::link(core_tag_tag::make_url($tag->tagcollid, $tag->rawname),
            core_tag_tag::make_display_name($tag));
        parent::__construct('core_tag', 'tagname', $tag->id, $editable, $displayvalue, $value, $edithint, $editlabel);
    }

    /**
     * Updates the value in database and returns itself, called from inplace_editable callback
     *
     * @param int $itemid
     * @param mixed $newvalue
     * @return \self
     */
    public static function update($itemid, $newvalue) {
        require_capability('moodle/tag:manage', context_system::instance());
        $tag = core_tag_tag::get($itemid, '*', MUST_EXIST);
        $tag->update(array('rawname' => $newvalue));
        return new self($tag);
    }
}
