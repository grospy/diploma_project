<?php
//

/**
 * Admin settings for the multichoice question type.
 *
 * @package   qtype_multichoice
 * @copyright  2015 onwards Nadav Kavalerchik
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $menu = array(
        new lang_string('answersingleno', 'qtype_multichoice'),
        new lang_string('answersingleyes', 'qtype_multichoice'),
    );
    $settings->add(new admin_setting_configselect('qtype_multichoice/answerhowmany',
    new lang_string('answerhowmany', 'qtype_multichoice'),
    new lang_string('answerhowmany_desc', 'qtype_multichoice'), '1', $menu));

    $settings->add(new admin_setting_configcheckbox('qtype_multichoice/shuffleanswers',
    new lang_string('shuffleanswers', 'qtype_multichoice'),
    new lang_string('shuffleanswers_desc', 'qtype_multichoice'), '1'));

    $settings->add(new qtype_multichoice_admin_setting_answernumbering('qtype_multichoice/answernumbering',
    new lang_string('answernumbering', 'qtype_multichoice'),
    new lang_string('answernumbering_desc', 'qtype_multichoice'), 'abc', null ));

}
