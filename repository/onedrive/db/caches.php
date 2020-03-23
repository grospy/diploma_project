<?php
//

/**
 * Cache definitions.
 *
 * @package    repository_onedrive
 * @copyright  2013 Dan Poltawski <dan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$definitions = array(
    // Used to store file ids for folders.
    // The keys used are full path to the folder, the values are the id in office 365.
    // The static acceleration size has been based upon the depths of a single path.
    'folder' => array(
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => false,
        'simpledata' => true,
        'staticacceleration' => true,
        'staticaccelerationsize' => 10,
        'canuselocalstore' => true
    ),
);
