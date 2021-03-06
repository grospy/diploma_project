<?php
//

/**
 * Book external functions and service definitions.
 *
 * @package    mod_book
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_book_view_book' => array(
        'classname'     => 'mod_book_external',
        'methodname'    => 'view_book',
        'description'   => 'Simulate the view.php web interface book: trigger events, completion, etc...',
        'type'          => 'write',
        'capabilities'  => 'mod/book:read',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),

    'mod_book_get_books_by_courses' => array(
        'classname'     => 'mod_book_external',
        'methodname'    => 'get_books_by_courses',
        'description'   => 'Returns a list of book instances in a provided set of courses,
                            if no courses are provided then all the book instances the user has access to will be returned.',
        'type'          => 'read',
        'capabilities'  => '',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    )
);
