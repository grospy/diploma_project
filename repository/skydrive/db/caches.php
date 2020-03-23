<?php
//

/**
 * Cache definitions.
 *
 * @package    repository_skydrive
 * @copyright  2013 Dan Poltawski <dan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$definitions = array(
    'foldername' => array(
        'mode' => cache_store::MODE_SESSION,
    )
);
