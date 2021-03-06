<?php
//

/**
 * @package    tool_xmldb
 * @copyright  2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This class will unload one loaded file completely
 *
 * @package    tool_xmldb
 * @copyright  2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class unload_xml_file extends XMLDBAction {

    /**
     * Init method, every subclass will have its own
     */
    function init() {
        parent::init();

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

        // These are always here
        global $CFG, $XMLDB;

        // Do the job, setting result as needed

        // Get the dir containing the file
        $dirpath = required_param('dir', PARAM_PATH);
        $dirpath = $CFG->dirroot . $dirpath;

        // Get the original dir and delete some elements
        if (!empty($XMLDB->dbdirs)) {
            if (isset($XMLDB->dbdirs[$dirpath])) {
                $dbdir = $XMLDB->dbdirs[$dirpath];
                if ($dbdir) {
                    unset($dbdir->xml_file);
                    unset($dbdir->xml_loaded);
                    unset($dbdir->xml_changed);
                    unset($dbdir->xml_exists);
                    unset($dbdir->xml_writeable);
                }
            }
        }
        // Get the edited dir and delete it completely
        if (!empty($XMLDB->editeddirs)) {
            if (isset($XMLDB->editeddirs[$dirpath])) {
                unset($XMLDB->editeddirs[$dirpath]);
            }
        }

        // Launch postaction if exists (leave this here!)
        if ($this->getPostAction() && $result) {
            return $this->launch($this->getPostAction());
        }

        // Return ok if arrived here
        return $result;
    }
}

