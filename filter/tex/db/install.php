<?php

//

/**
 * Tex filter post install hook
 *
 * @package    filter
 * @subpackage tex
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_filter_tex_install() {
    global $CFG;

    // purge all caches during installation

    require_once("$CFG->dirroot/filter/tex/lib.php");
    filter_tex_updatedcallback(null);
}

