<?php
//

/**
 * Form for editing badges block instances.
 *
 * @package    block_badges
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

class block_badges_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $numberofbadges = array('0' => get_string('all'));
        for ($i = 1; $i <= 20; $i++) {
            $numberofbadges[$i] = $i;
        }

        $mform->addElement('select', 'config_numberofbadges', get_string('numbadgestodisplay', 'block_badges'), $numberofbadges);
        $mform->setDefault('config_numberofbadges', 10);
    }
}