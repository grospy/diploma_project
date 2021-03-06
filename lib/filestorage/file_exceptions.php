<?php
//

/**
 * File handling related exceptions.
 *
 * @package   core_files
 * @copyright 2008 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Basic file related exception class.
 *
 * @package   core_files
 * @category  files
 * @copyright 2008 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class file_exception extends moodle_exception {
    /**
     * Constructor
     *
     * @param string $errorcode error code
     * @param stdClass $a Extra words and phrases that might be required in the error string
     * @param string $debuginfo optional debugging information
     */
    function __construct($errorcode, $a=NULL, $debuginfo = NULL) {
        parent::__construct($errorcode, '', '', $a, $debuginfo);
    }
}

/**
 * Can not create file exception.
 *
 * @package   core_files
 * @category  files
 * @copyright 2008 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class stored_file_creation_exception extends file_exception {
    /**
     * Constructor.
     *
     * @param int $contextid context ID
     * @param string $component component
     * @param string $filearea file area
     * @param int $itemid item ID
     * @param string $filepath file path
     * @param string $filename file name
     * @param string $debuginfo extra debug info
     */
    function __construct($contextid, $component, $filearea, $itemid, $filepath, $filename, $debuginfo = null) {
        $a = new stdClass();
        $a->contextid = $contextid;
        $a->component = $component;
        $a->filearea  = $filearea;
        $a->itemid    = $itemid;
        $a->filepath  = $filepath;
        $a->filename  = $filename;
        parent::__construct('storedfilenotcreated', $a, $debuginfo);
    }
}

/**
 * No file access exception.
 *
 * @package   core_files
 * @category  files
 * @copyright 2008 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class file_access_exception extends file_exception {
    /**
     * Constructor.
     *
     * @param string $debuginfo extra debug info
     */
    public function __construct($debuginfo = null) {
        parent::__construct('nopermissions', null, $debuginfo);
    }
}

/**
 * Hash file content problem exception.
 *
 * @package   core_files
 * @category  files
 * @copyright 2008 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class file_pool_content_exception extends file_exception {
    /**
     * Constructor.
     *
     * @param string $contenthash content hash
     * @param string $debuginfo extra debug info
     */
    public function __construct($contenthash, $debuginfo = null) {
        parent::__construct('hashpoolproblem', $contenthash, $debuginfo);
    }
}


/**
 * Problem with records in the {files_reference} table.
 *
 * @package   core_files
 * @category  files
 * @copyright 2012 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class file_reference_exception extends file_exception {
    /**
     * Constructor.
     *
     * @param int $repositoryid the id of the repository that provides the referenced file
     * @param string $reference the information for the repository to locate the file
     * @param int|null $referencefileid the id of the record in {files_reference} if known
     * @param int|null $fileid the id of the referrer's record in {files} if known
     * @param string|null $debuginfo extra debug info
     */
    function __construct($repositoryid, $reference, $referencefileid=null, $fileid=null, $debuginfo=null) {
        $a = new stdClass();
        $a->repositoryid = $repositoryid;
        $a->reference = $reference;
        $a->referencefileid = $referencefileid;
        $a->fileid = $fileid;
        parent::__construct('filereferenceproblem', $a, $debuginfo);
    }
}
