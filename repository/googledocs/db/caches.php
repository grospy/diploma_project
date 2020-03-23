<?php
//

/**
 * Googledocs repository cache definitions.
 *
 * This file is part of Moodle's cache API, affectionately called MUC.
 * It contains the components that are requried in order to use caching.
 *
 * @package    repository_googledocs
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$definitions = array(

    // Used to store file ids for folders.
    // The keys used are full path to the folder, the values are the id in google drive.
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
