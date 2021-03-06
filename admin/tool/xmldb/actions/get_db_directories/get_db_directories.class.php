<?php
//

/**
 * @package    tool_xmldb
 * @copyright  2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This class will will check all the db directories existing under the
 * current Moodle installation, sending them to the SESSION->dbdirs array
 *
 * @package    tool_xmldb
 * @copyright  2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class get_db_directories extends XMLDBAction {

    /**
     * Init method, every subclass will have its own
     */
    function init() {
        parent::init();
        // Set own core attributes
        $this->can_subaction = ACTION_NONE;
        //$this->can_subaction = ACTION_HAVE_SUBACTIONS;

        // Set own custom attributes
        $this->sesskey_protected = false; // This action doesn't need sesskey protection

        // Get needed strings
        $this->loadStrings(array(
            // 'key' => 'module',
        ));
    }

    /**
     * Invoke method, every class will have its own
     * returns true/false on completion, setting both
     * errormsg and output as necessary
     */
    function invoke() {
        parent::invoke();

        $result = true;

        // Set own core attributes
        $this->does_generate = ACTION_NONE;
        //$this->does_generate = ACTION_GENERATE_HTML;

        // These are always here
        global $CFG, $XMLDB;

        // Do the job, setting $result as needed

        // Lets go to add all the db directories available inside Moodle
        // Create the array if it doesn't exists
        if (!isset($XMLDB->dbdirs)) {
            $XMLDB->dbdirs = array();
        }

        // get list of all dirs and create objects with status
        $db_directories = get_db_directories();
        foreach ($db_directories as $path) {
            $dbdir = new stdClass;
            $dbdir->path = $path;
            if (!isset($XMLDB->dbdirs[$dbdir->path])) {
                $XMLDB->dbdirs[$dbdir->path] = $dbdir;
             }
            $XMLDB->dbdirs[$dbdir->path]->path_exists = file_exists($dbdir->path);  //Update status
         }

        // Sort by key
        ksort($XMLDB->dbdirs);

        // Return ok if arrived here
        return true;
    }
}

