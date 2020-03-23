<?php
//

/**
 * The author exporter tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\author as author_entity;
use mod_forum\local\exporters\author as author_exporter;
global $CFG;

/**
 * The author exporter tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_exporters_author_testcase extends advanced_testcase {
    /**
     * Test the export function returns expected values.
     */
    public function test_export_author() {
        global $PAGE;
        $this->resetAfterTest();

        $renderer = $PAGE->get_renderer('core');
        $datagenerator = $this->getDataGenerator();
        $course = $datagenerator->create_course();
        $forum = $datagenerator->create_module('forum', ['course' => $course->id]);
        $coursemodule = get_coursemodule_from_instance('forum', $forum->id);
        $context = context_module::instance($coursemodule->id);
        $entityfactory = \mod_forum\local\container::get_entity_factory();
        $forum = $entityfactory->get_forum_from_stdclass($forum, $context, $coursemodule, $course);
        $author = new author_entity(
            1,
            1,
            'test',
            'user',
            'test user',
            'test@example.com',
            false
        );

        $exporter = new author_exporter($author, 1, [], true, [
            'urlfactory' => \mod_forum\local\container::get_url_factory(),
            'context' => $context,
            'forum' => $forum,
        ]);

        $exportedauthor = $exporter->export($renderer);

        $this->assertEquals(1, $exportedauthor->id);
        $this->assertEquals('test user', $exportedauthor->fullname);
        $this->assertEquals([], $exportedauthor->groups);
        $this->assertNotEquals(null, $exportedauthor->urls['profile']);
        $this->assertNotEquals(null, $exportedauthor->urls['profileimage']);
    }

    /**
     * Test the export function with groups.
     */
    public function test_export_author_with_groups() {
        global $PAGE;
        $this->resetAfterTest();

        $renderer = $PAGE->get_renderer('core');
        $datagenerator = $this->getDataGenerator();
        $course = $datagenerator->create_course();
        $forum = $datagenerator->create_module('forum', ['course' => $course->id]);
        $coursemodule = get_coursemodule_from_instance('forum', $forum->id);
        $context = context_module::instance($coursemodule->id);
        $entityfactory = \mod_forum\local\container::get_entity_factory();
        $forum = $entityfactory->get_forum_from_stdclass($forum, $context, $coursemodule, $course);
        $author = new author_entity(
            1,
            1,
            'test',
            'user',
            'test user',
            'test@example.com',
            false
        );

        $group = $datagenerator->create_group(['courseid' => $course->id]);

        $exporter = new author_exporter($author, 1, [$group], true, [
            'urlfactory' => \mod_forum\local\container::get_url_factory(),
            'context' => $context,
            'forum' => $forum,
        ]);

        $exportedauthor = $exporter->export($renderer);

        $this->assertCount(1, $exportedauthor->groups);
        $this->assertEquals($group->id, $exportedauthor->groups[0]['id']);
    }

    /**
     * Test the export function with no view capability.
     */
    public function test_export_author_no_view_capability() {
        global $PAGE;
        $this->resetAfterTest();

        $renderer = $PAGE->get_renderer('core');
        $datagenerator = $this->getDataGenerator();
        $course = $datagenerator->create_course();
        $forum = $datagenerator->create_module('forum', ['course' => $course->id]);
        $coursemodule = get_coursemodule_from_instance('forum', $forum->id);
        $context = context_module::instance($coursemodule->id);
        $entityfactory = \mod_forum\local\container::get_entity_factory();
        $forum = $entityfactory->get_forum_from_stdclass($forum, $context, $coursemodule, $course);
        $author = new author_entity(
            1,
            1,
            'test',
            'user',
            'test user',
            'test@example.com',
            false
        );

        $group = $datagenerator->create_group(['courseid' => $course->id]);

        $exporter = new author_exporter($author, 1, [$group], false, [
            'urlfactory' => \mod_forum\local\container::get_url_factory(),
            'context' => $context,
            'forum' => $forum,
        ]);

        $exportedauthor = $exporter->export($renderer);

        $this->assertEquals(null, $exportedauthor->id);
        $this->assertNotEquals('test user', $exportedauthor->fullname);
        $this->assertEquals([], $exportedauthor->groups);
        $this->assertEquals(null, $exportedauthor->urls['profile']);
        $this->assertEquals(null, $exportedauthor->urls['profileimage']);
    }
}
