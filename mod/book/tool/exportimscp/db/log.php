<?php
//

/**
 * Export to IMSCP booktool log events definition
 *
 * @package    booktool_exportimscp
 * @copyright  2012 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'book', 'action'=>'exportimscp', 'mtable'=>'book', 'field'=>'name')
);
