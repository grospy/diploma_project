<?php
//

/**
 * PGSQL specific temptables store. Needed because temporary tables
 * are named differently than normal tables. Also used to be able to retrieve
 * temp table names included in the get_tables() method of the DB.
 *
 * @package    core_dml
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/moodle_temptables.php');

class pgsql_native_moodle_temptables extends moodle_temptables {
    /**
     * Analyze the data in temporary tables to force statistics collection after bulk data loads.
     * PostgreSQL does not natively support automatic temporary table stats collection, so we do it.
     *
     * @return void
     */
    public function update_stats() {
        $temptables = $this->get_temptables();
        foreach ($temptables as $temptablename) {
            $this->mdb->execute("ANALYZE {".$temptablename."}");
        }
    }
}
