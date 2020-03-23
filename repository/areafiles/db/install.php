<?php
//

/**
 * Creating a default instance of areafiles repository on install
 *
 * @package    repository_areafiles
 * @copyright  2013 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_repository_areafiles_install() {
    global $CFG;
    $result = true;
    require_once($CFG->dirroot.'/repository/lib.php');
    $areafiles_plugin = new repository_type('areafiles', array(), true);
    if(!$id = $areafiles_plugin->create(true)) {
        $result = false;
    }
    return $result;
}
