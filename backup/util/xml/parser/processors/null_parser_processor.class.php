<?php

//

/**
 * @package moodlecore
 * @subpackage xml
 * @copyright 2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/backup/util/xml/parser/processors/progressive_parser_processor.class.php');

/**
 * Null progressive_parser_processor that won't process chunks at all.
 * Useful for comparing memory use/execution time.
 */
class null_parser_processor extends progressive_parser_processor {

   public function process_chunk($data) {
   }
}
