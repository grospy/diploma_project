<?php
//

/**
 * Create admin bookmarks.
 *
 * @package    block_admin_bookmarks
 * @copyright  2006 vinkmar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_once($CFG->libdir.'/adminlib.php');
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$adminroot = admin_get_root(false, false);  // settings not required - only pages

if ($section = optional_param('section', '', PARAM_SAFEDIR) and confirm_sesskey()) {

    if (get_user_preferences('admin_bookmarks')) {
        $bookmarks = explode(',', get_user_preferences('admin_bookmarks'));

        if (in_array($section, $bookmarks)) {
            print_error('bookmarkalreadyexists','admin');
            die;
        }

    } else {
        $bookmarks = array();
    }

    $temp = $adminroot->locate($section);

    if ($temp instanceof admin_settingpage || $temp instanceof admin_externalpage || $temp instanceof admin_category) {
        $bookmarks[] = $section;
        $bookmarks = implode(',', $bookmarks);
        set_user_preference('admin_bookmarks', $bookmarks);

    } else {
        print_error('invalidsection','admin');
        die;
    }

    if ($temp instanceof admin_settingpage) {
        redirect($CFG->wwwroot . '/' . $CFG->admin . '/settings.php?section=' . $section);

    } elseif ($temp instanceof admin_externalpage) {
        redirect($temp->url);

    } else if ($temp instanceof admin_category) {
        redirect($CFG->wwwroot . '/' . $CFG->admin . '/category.php?category=' . $section);

    }

} else {
    print_error('invalidsection','admin');
    die;
}


