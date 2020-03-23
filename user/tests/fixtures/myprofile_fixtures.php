<?php
//

/**
 * Defines fixutres for unit testing of lib/classes/myprofile/.
 *
 * @package   core_user
 * @category  test
 * @copyright 2015 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class phpunit_fixture_myprofile_category
 *
 * @package   core_user
 * @category  test
 * @copyright 2015 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class phpunit_fixture_myprofile_category extends \core_user\output\myprofile\category {
    /**
     * Make protected method public for testing.
     *
     * @param node $node
     * @return node Nodes after the specified node.
     */
    public function find_nodes_after($node) {
        return parent::find_nodes_after($node);
    }

    /**
     * Make protected method public for testing.
     */
    public function validate_after_order() {
        parent::validate_after_order();
    }
}

/**
 * Class phpunit_fixture_myprofile_tree
 *
 * @package   core_user
 * @category  test
 * @copyright 2015 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class phpunit_fixture_myprofile_tree extends \core_user\output\myprofile\tree {
    /**
     * Make protected method public for testing.
     *
     * @param category $cat Category object
     * @return array An array of category objects.
     */
    public function find_categories_after($cat) {
        return parent::find_categories_after($cat);
    }
}