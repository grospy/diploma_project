<?php
//

/**
 * Helpers for the core_rating subsystem implementation of privacy.
 *
 * @package    core_rating
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_rating\phpunit;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\tests\request\content_writer;

global $CFG;

/**
 * Helpers for the core_rating subsystem implementation of privacy.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
trait privacy_helper {
    /**
     * Fetch all ratings on a subcontext.
     *
     * @param   \context            $context    The context being stored.
     * @param   array               $subcontext The subcontext path to check.
     * @return  array
     */
    protected function get_ratings_on_subcontext(\context $context, array $subcontext) {
        $writer = \core_privacy\local\request\writer::with_context($context);
        return $writer->get_related_data($subcontext, 'rating');
    }

    /**
     * Check that all included ratings belong to the specified user.
     *
     * @param   int                 $userid     The ID of the user being stored.
     * @param   \context            $context    The context being stored.
     * @param   array               $subcontext The subcontext path to check.
     * @param   string              $component  The component being stored.
     * @param   string              $ratingarea The rating area to store results for.
     * @param   int                 $itemid     The itemid to store.
     */
    protected function assert_all_own_ratings_on_context(
        int $userid,
        \context $context,
        array $subcontext,
        $component,
        $ratingarea,
        $itemid
    ) {
        $writer = \core_privacy\local\request\writer::with_context($context);
        $rm = new \rating_manager();
        $dbratings = $rm->get_all_ratings_for_item((object) [
            'context' => $context,
            'component' => $component,
            'ratingarea' => $ratingarea,
            'itemid' => $itemid,
        ]);

        $exportedratings = $this->get_ratings_on_subcontext($context, $subcontext);

        foreach ($exportedratings as $ratingid => $rating) {
            $this->assertTrue(isset($dbratings[$ratingid]));
            $this->assertEquals($userid, $rating->author);
            $this->assert_rating_matches($dbratings[$ratingid], $rating);
        }

        foreach ($dbratings as $rating) {
            if ($rating->userid == $userid) {
                $this->assertEquals($rating->id, $ratingid);
            }
        }
    }

    /**
     * Check that all included ratings are valid. They may belong to any user.
     *
     * @param   \context            $context    The context being stored.
     * @param   array               $subcontext The subcontext path to check.
     * @param   string              $component  The component being stored.
     * @param   string              $ratingarea The rating area to store results for.
     * @param   int                 $itemid     The itemid to store.
     */
    protected function assert_all_ratings_on_context(\context $context, array $subcontext, $component, $ratingarea, $itemid) {
        $writer = \core_privacy\local\request\writer::with_context($context);
        $rm = new \rating_manager();
        $dbratings = $rm->get_all_ratings_for_item((object) [
            'context' => $context,
            'component' => $component,
            'ratingarea' => $ratingarea,
            'itemid' => $itemid,
        ]);

        $exportedratings = $this->get_ratings_on_subcontext($context, $subcontext);

        foreach ($exportedratings as $ratingid => $rating) {
            $this->assertTrue(isset($dbratings[$ratingid]));
            $this->assert_rating_matches($dbratings[$ratingid], $rating);
        }

        foreach ($dbratings as $rating) {
            $this->assertTrue(isset($exportedratings[$rating->id]));
        }
    }

    /**
     * Assert that the rating matches.
     *
     * @param   \stdClass           $expected   The expected rating structure
     * @param   \stdClass           $stored     The actual rating structure
     */
    protected function assert_rating_matches($expected, $stored) {
        $this->assertEquals($expected->rating, $stored->rating);
        $this->assertEquals($expected->userid, $stored->author);
    }
}
