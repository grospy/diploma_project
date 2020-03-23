<?php
//

/**
 * Label external functions and service definitions.
 *
 * @package    mod_label
 * @category   external
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.3
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_label_get_labels_by_courses' => array(
        'classname'     => 'mod_label_external',
        'methodname'    => 'get_labels_by_courses',
        'description'   => 'Returns a list of labels in a provided list of courses, if no list is provided all labels that the user
                            can view will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/label:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
