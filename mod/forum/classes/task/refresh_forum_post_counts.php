<?php
//

/**
 * Adhoc task that updates all of the existing forum_post records with no wordcount or no charcount.
 *
 * @package    mod_forum
 * @copyright  2019 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Adhoc task that updates all of the existing forum_post records with no wordcount or no charcount.
 *
 * @package     mod_forum
 * @copyright   2019 David Monllao
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class refresh_forum_post_counts extends \core\task\adhoc_task {

    /**
     * Run the task to populate word and character counts on existing forum posts.
     * If the maximum number of records are updated, the task re-queues itself,
     * as there may be more records to process.
     */
    public function execute() {
        if ($this->update_null_forum_post_counts()) {
            \core\task\manager::queue_adhoc_task(new refresh_forum_post_counts());
        }
    }

    /**
     * Updates null forum post counts according to the post message.
     *
     * @return bool Whether there may be more rows to process
     */
    protected function update_null_forum_post_counts(): bool {
        global $CFG, $DB;

        // Default to chunks of 5000 records per run, unless overridden in config.php.
        $chunksize = $CFG->forumpostcountchunksize ?? 5000;

        // Initialize counter.
        $recordscount = 0;

        $select = 'wordcount IS NULL OR charcount IS NULL';
        $recordset = $DB->get_recordset_select('forum_posts', $select, null, 'discussion', 'id, message', 0, $chunksize);

        if (!$recordset->valid()) {
            $recordset->close();
            return false;
        }

        foreach ($recordset as $record) {
            \mod_forum\local\entities\post::add_message_counts($record);
            $DB->update_record('forum_posts', $record);
            $recordscount++;
        }

        $recordset->close();

        return ($recordscount == $chunksize);
    }
}
