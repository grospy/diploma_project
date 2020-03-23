<?php
//

/**
 * Test block area.
 *
 * @package core_search
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_mockblock\search;

defined('MOODLE_INTERNAL') || die;

/**
 * Test block area.
 *
 * @package core_search
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class area extends \core_search\base_block {
    public function get_document($record, $options = array()) {
        throw new \coding_exception('Not implemented');
    }
}
