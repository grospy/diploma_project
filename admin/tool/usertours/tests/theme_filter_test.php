<?php
//

/**
 * Tests for theme filter.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Tests for theme filter.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_usertours_theme_filter_testcase extends advanced_testcase {

    /**
     * Data Provider for filter_matches function.
     *
     * @return array
     */
    public function filter_matches_provider() {
        return [
            'No config set; Matches' => [
                null,
                'boost',
                true,
            ],
            'Empty config set; Matches' => [
                [],
                'boost',
                true,
            ],
            'Single matching value set; Matches' => [
                ['boost'],
                'boost',
                true,
            ],
            'Multiple values set including matching; Matches' => [
                ['boost', 'classic'],
                'boost',
                true,
            ],
            'Single value set; No match' => [
                ['classic'],
                'boost',
                false,
            ],
            'Multiple values set; No match' => [
                ['classic', 'artificial'],
                'boost',
                false,
            ],
        ];
    }

    /**
     * Test the filter_matches function.
     *
     * @dataProvider    filter_matches_provider
     * @param   array       $filtervalues   The filter values
     * @param   string      $currenttheme   The name of the current theme
     * @param   boolean     $expected       Whether the tour is expected to match
     */
    public function test_filter_matches($filtervalues, $currenttheme, $expected) {
        global $PAGE;

        $filtername = \tool_usertours\local\filter\theme::class;

        // Note: No need to persist this tour.
        $tour = new \tool_usertours\tour();
        if ($filtervalues !== null) {
            $tour->set_filter_values('theme', $filtervalues);
        }

        $PAGE->theme->name = $currenttheme;

        // Note: The theme filter does not use the context.
        $this->assertEquals($expected, $filtername::filter_matches($tour, \context_system::instance()));
    }
}
