<?php
//

/**
 * Extract context vault preprocessor.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\vaults\preprocessors;

defined('MOODLE_INTERNAL') || die();

use context;
use context_helper;

/**
 * Extract context vault preprocessor.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class extract_context {
    /**
     * Extract the contexts from a list of records.
     *
     * @param stdClass[] $records The list of records which have context properties
     * @return context[] List of contexts matching the records.
     */
    public function execute(array $records) : array {
        return array_map(function($record) {
            $contextid = $record->ctxid;
            context_helper::preload_from_record($record);
            $context = context::instance_by_id($contextid);
            return $context;
        }, $records);
    }
}
