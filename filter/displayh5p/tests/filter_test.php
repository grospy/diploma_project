<?php
//

/**
 * Unit tests for the filter_displayh5p
 *
 * @package    filter_displayh5p
 * @category   test
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot.'/filter/displayh5p/filter.php');

/**
 * Unit tests for the display H5P filter.
 *
 * @copyright 2019 Victor Deniz <victor@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_displayh5p_testcase extends advanced_testcase {

    public function setUp() {
        parent::setUp();

        $this->resetAfterTest(true);

        set_config('allowedsources',
            "https://h5p.org/h5p/embed/[id]\nhttps://moodle.h5p.com/content/[id]/embed\nhttps://moodle.h5p.com/content/[id]
                \nhttps://generic.wordpress.soton.ac.uk/altc/wp-admin/admin-ajax.php?action=h5p_embed&id=[id]",
            'filter_displayh5p');
    }

    /**
     * Check that h5p tags with urls from allowed domains are filtered.
     *
     * @param string $text Original text
     * @param string $filteredtextpattern Text pattern after display H5P filter
     *
     * @dataProvider texts_provider
     */
    public function test_filter_urls($text, $filteredtextpattern) {

        $filterplugin = new filter_displayh5p(null, array());

        $filteredtext = $filterplugin->filter($text);
        $this->assertRegExp($filteredtextpattern, $filteredtext);
    }

    /**
     * Provides texts to filter for the {@link self::test_filter_urls} method.
     *
     * @return array
     */
    public function texts_provider() {
        global $CFG;

        return [
            ["http:://example.com", "#http:://example.com#"],
            ["http://google.es/h5p/embed/3425234", "#http://google.es/h5p/embed/3425234#"],
            ["https://h5p.org/h5p/embed/547225", "#<iframe src=\"https://h5p.org/h5p/embed/547225\"[^>]+?>#"],
            ["https://moodle.h5p.com/content/1290729733828858779/embed", "#<iframe src=\"https://moodle.h5p.com/content/1290729733828858779/embed\"[^>]+?>#"],
            ["https://moodle.h5p.com/content/1290729733828858779", "#<iframe src=\"https://moodle.h5p.com/content/1290729733828858779/embed\"[^>]+?>#"],
            ["<a href=\"https://h5p.org/h5p/embed/547225\">link</a>",  "#^((?!iframe).)*$#"],
            ["this is a text with an h5p url https://h5p.org/h5p/embed/547225 inside",
                    "#this is a text with an h5p url <iframe src=\"https://h5p.org/h5p/embed/547225\"(.|\n)*> inside#"],
            ["https://generic.wordpress.soton.ac.uk/altc/wp-admin/admin-ajax.php?action=h5p_embed&amp;id=13",
                    "#<iframe src=\"https://generic.wordpress.soton.ac.uk/altc/wp-admin/admin-ajax.php\?action=h5p_embed\&amp\;id=13\"[^>]+?>#"],
            ["https://h5p.org/h5p/embed/547225 another content in the same page https://moodle.h5p.com/content/1290729733828858779/embed",
                    "#<iframe src=\"https://h5p.org/h5p/embed/547225\"[^>]+?>((?!<iframe).)*<iframe src=\"https://moodle.h5p.com/content/1290729733828858779/embed\"[^>]+?>#"],
            [$CFG->wwwroot."/pluginfile.php/5/user/private/interactive-video.h5p?export=1&embed=1",
                    "#<iframe src=\"{$CFG->wwwroot}/h5p/embed.php\?url=".rawurlencode("{$CFG->wwwroot}/pluginfile.php/5/user/private/interactive-video.h5p").
                    "&export=1&embed=1\"[^>]*?></iframe>#"],
            [$CFG->wwwroot."/pluginfile.php/5/user/private/accordion-6-7138%20%281%29.h5p.h5p",
                    "#<iframe src=\"{$CFG->wwwroot}/h5p/embed.php\?url=".rawurlencode("{$CFG->wwwroot}/pluginfile.php/5/user/private/accordion-6-7138%20%281%29.h5p.h5p").
                    "\"[^>]*?></iframe>#"]
        ];
    }
}