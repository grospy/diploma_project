<?php
//

/**
 * The discussion entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\sorter as sorter_entity;

/**
 * The discussion entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_entities_sorter_testcase extends advanced_testcase {
    /**
     * Test the entity returns expected values.
     */
    public function test_entity_sort_into_children() {
        $this->resetAfterTest();
        $sorter = new sorter_entity(
            function($entity) {
                return $entity['id'];
            },
            function($entity) {
                return $entity['parent'];
            }
        );

        $a = ['id' => 1, 'parent' => 0];
        $b = ['id' => 2, 'parent' => 1];
        $c = ['id' => 3, 'parent' => 1];
        $d = ['id' => 4, 'parent' => 2];
        $e = ['id' => 5, 'parent' => 0];

        $expected = [
            [$e, []],
            [$a, [[$b, [[$d, []]]], [$c, []]]],
        ];

        $actual = $sorter->sort_into_children([$d, $b, $e, $a, $c]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test the entity returns expected values.
     */
    public function test_entity_flatten_children() {
        $this->resetAfterTest();
        $sorter = new sorter_entity(
            function($entity) {
                return $entity['id'];
            },
            function($entity) {
                return $entity['parent'];
            }
        );

        $a = ['id' => 1, 'parent' => 0];
        $b = ['id' => 2, 'parent' => 1];
        $c = ['id' => 3, 'parent' => 1];
        $d = ['id' => 4, 'parent' => 3];

        $sorted = [
            [$a, [[$b, [[$d, []]]], [$c, []]]]
        ];

        $expected = [$a, $b, $d, $c];
        $actual = $sorter->flatten_children($sorted);

        $this->assertEquals($expected, $actual);
    }
}
