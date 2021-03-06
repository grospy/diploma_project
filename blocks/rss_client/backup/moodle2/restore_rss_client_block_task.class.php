<?php
//

/**
 * @package    block_rss_client
 * @subpackage backup-moodle2
 * @copyright 2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/blocks/rss_client/backup/moodle2/restore_rss_client_stepslib.php'); // We have structure steps

/**
 * Specialised restore task for the rss_client block
 * (has own DB structures to backup)
 *
 * TODO: Finish phpdocs
 */
class restore_rss_client_block_task extends restore_block_task {

    protected function define_my_settings() {
    }

    protected function define_my_steps() {
        // rss_client has one structure step
        $this->add_step(new restore_rss_client_block_structure_step('rss_client_structure', 'rss_client.xml'));
    }

    public function get_fileareas() {
        return array(); // No associated fileareas
    }

    public function get_configdata_encoded_attributes() {
        return array(); // No special handling of configdata
    }

    static public function define_decode_contents() {
        return array();
    }

    static public function define_decode_rules() {
        return array();
    }
}

