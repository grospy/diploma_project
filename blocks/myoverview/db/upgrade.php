<?php
//

/**
 * This file keeps track of upgrades to the myoverview block
 *
 * @since 3.8
 * @package block_myoverview
 * @copyright 2019 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the MyOverview block.
 *
 * @param int $oldversion
 */
function xmldb_block_myoverview_upgrade($oldversion) {
    global $DB;

    if ($oldversion < 2019091800) {
        // Remove orphaned course favourites, which weren't being deleted when the course was deleted.
        $sql = 'SELECT f.id
                  FROM {favourite} f
             LEFT JOIN {course} c
                    ON (c.id = f.itemid)
                 WHERE f.component = :component
                   AND f.itemtype = :itemtype
                   AND c.id IS NULL';
        $params = ['component' => 'core_course', 'itemtype' => 'courses'];

        if ($records = $DB->get_fieldset_sql($sql, $params)) {
            $chunks = array_chunk($records, 1000);
            foreach ($chunks as $chunk) {
                list($insql, $inparams) = $DB->get_in_or_equal($chunk);
                $DB->delete_records_select('favourite', "id $insql", $inparams);
            }
        }

        upgrade_block_savepoint(true, 2019091800, 'myoverview', false);
    }

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
