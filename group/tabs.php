<?php
//

/**
 * Prints navigation tabs
 *
 * @package    core_group
 * @copyright  2010 Petr Skoda (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
    $row = array();
    $row[] = new tabobject('groups',
                           new moodle_url('/group/index.php', array('id' => $courseid)),
                           get_string('groups'));

    $row[] = new tabobject('groupings',
                           new moodle_url('/group/groupings.php', array('id' => $courseid)),
                           get_string('groupings', 'group'));

    $row[] = new tabobject('overview',
                           new moodle_url('/group/overview.php', array('id' => $courseid)),
                           get_string('overview', 'group'));
    echo '<div class="groupdisplay">';
    echo $OUTPUT->tabtree($row, $currenttab);
    echo '</div>';
