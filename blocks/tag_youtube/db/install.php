<?php
//

/**
 * Tag Youtube block installation.
 *
 * @package    block_tag_youtube
 * @copyright  2015 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Sets the install values for the tag_youtube entry in the block table.
 *
 * @return void
 */
function xmldb_block_tag_youtube_install() {
    global $DB;

    // Disable this block by default.
    $DB->set_field('block', 'visible', 0, array('name' => 'tag_youtube'));
}

