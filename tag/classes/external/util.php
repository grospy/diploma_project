<?php
//

/**
 * Tag external functions utility class.
 *
 * @package    core_tag
 * @copyright  2019 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

use core_tag\external\tag_item_exporter;
use core_tag_tag;

/**
 * Tag external functions utility class.
 *
 * @package   core_tag
 * @copyright 2019 Juan Leyva
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since     Moodle 3.7
 */
class util {


    /**
     * Get the array of core_tag_tag objects for external functions associated with an item (instances).
     *
     * @param string $component component responsible for tagging. For BC it can be empty but in this case the
     *               query will be slow because DB index will not be used.
     * @param string $itemtype type of the tagged item
     * @param int $itemid
     * @param int $standardonly wether to return only standard tags or any
     * @param int $tiuserid tag instance user id, only needed for tag areas with user tagging
     * @return array tags for external functions
     */
    public static function get_item_tags($component, $itemtype, $itemid, $standardonly = core_tag_tag::BOTH_STANDARD_AND_NOT,
            $tiuserid = 0) {
        global $PAGE;

        $output = $PAGE->get_renderer('core');

        $tagitems = core_tag_tag::get_item_tags($component, $itemtype, $itemid, $standardonly, $tiuserid);
        $exportedtags = [];
        foreach ($tagitems as $tagitem) {
            $exporter = new tag_item_exporter($tagitem->to_object());
            $exportedtags[] = (array) $exporter->export($output);
        }
        return $exportedtags;
    }
}
