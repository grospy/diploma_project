<?php
//

/**
 * Unit tests for the filtered_userlist.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Unit tests for the filtered_userlist.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_filtered_userlist_testcase extends advanced_testcase {
    /**
     * Test the apply_expired_contexts_filters function with arange of options.
     *
     * @dataProvider apply_expired_contexts_filters_provider
     * @param   array   $initial The set of userids in the initial filterlist.
     * @param   array   $expired The set of userids considered as expired.
     * @param   array   $unexpired The set of userids considered as unexpired.
     * @param   array   $expected The expected values.
     */
    public function test_apply_expired_contexts_filters(array $initial, array $expired, array $unexpired, array $expected) {
        $userlist = $this->getMockBuilder(\tool_dataprivacy\filtered_userlist::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $rc = new \ReflectionClass(\tool_dataprivacy\filtered_userlist::class);
        $rcm = $rc->getMethod('set_userids');
        $rcm->setAccessible(true);
        $rcm->invoke($userlist, $initial);


        $userlist->apply_expired_context_filters($expired, $unexpired);
        $filtered = $userlist->get_userids();

        sort($expected);
        sort($filtered);
        $this->assertEquals($expected, $filtered);
    }

    /**
     * Data provider for the apply_expired_contexts_filters function.
     *
     * @return  array
     */
    public function apply_expired_contexts_filters_provider() : array {
        return [
            // Entire list should be preserved.
            'No overrides' => [
                'users' => [1, 2, 3, 4, 5],
                'expired' => [],
                'unexpired' => [],
                [1, 2, 3, 4, 5],
            ],
            // The list should be filtered to only keep the expired users.
            'Expired only' => [
                'users' => [1, 2, 3, 4, 5],
                'expired' => [2, 3, 4],
                'unexpired' => [],
                'expected' => [2, 3, 4],
            ],
            // The list should be filtered to remove any unexpired users.
            'Unexpired only' => [
                'users' => [1, 2, 3, 4, 5],
                'expired' => [],
                'unexpired' => [1, 5],
                'expected' => [2, 3, 4],
            ],
            // The list should be filtered to only keep expired users who are not on the unexpired list.
            'Combination of expired and unexpired' => [
                'users' => [1, 2, 3, 4, 5],
                'expired' => [1, 2, 3],
                'unexpired' => [1, 5],
                'expected' => [2, 3],
            ],
        ];
    }
}
