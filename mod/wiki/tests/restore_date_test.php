<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_wiki
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_wiki
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_wiki_restore_date_testcase extends restore_date_testcase {

    /**
     * Test restore dates.
     */
    public function test_restore_dates() {
        global $DB;

        $record = ['editbegin' => 100, 'editend' => 100, 'timemodified' => 100];
        list($course, $wiki) = $this->create_course_and_module('wiki', $record);

        $wikigenerator = $this->getDataGenerator()->get_plugin_generator('mod_wiki');
        $page = $wikigenerator->create_first_page($wiki);
        $version = $DB->get_record('wiki_versions', ['pageid' => $page->id, 'version' => 1]);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newwiki = $DB->get_record('wiki', ['course' => $newcourseid]);

        $this->assertFieldsNotRolledForward($wiki, $newwiki, ['timecreated', 'timemodified']);
        $props = ['editend', 'editbegin'];
        $this->assertFieldsRolledForward($wiki, $newwiki, $props);

        $newsubwiki = $DB->get_record('wiki_subwikis', ['wikiid' => $newwiki->id]);
        $newpage = $DB->get_record('wiki_pages', ['subwikiid' => $newsubwiki->id]);
        $newversion = $DB->get_record('wiki_versions', ['pageid' => $newpage->id, 'version' => 1]);

        // Wiki page time checks.
        $this->assertEquals($page->timecreated, $newpage->timecreated);
        $this->assertEquals($page->timemodified, $newpage->timemodified);
        $this->assertEquals($page->timerendered, $newpage->timerendered);

        // Wiki version time checks.
        $this->assertEquals($version->timecreated, $newversion->timecreated);

    }
}
