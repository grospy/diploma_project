<?php
//

/**
 * Unit tests for the {@link filter_manager} class.
 *
 * @package   core
 * @category  test
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Unit tests for the {@link filter_manager} class.
 *
 * @copyright 2015 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */
class core_filter_manager_testcase extends advanced_testcase {

    /**
     * Helper method to apply filters to some text and return the result.
     * @param string $text the text to filter.
     * @param array $skipfilters any filters not to apply, even if they are configured.
     * @return string the filtered text.
     */
    protected function filter_text($text, $skipfilters) {
        global $PAGE;
        $filtermanager = filter_manager::instance();
        $filtermanager->setup_page_for_filters($PAGE, $PAGE->context);
        $filteroptions = array(
                'originalformat' => FORMAT_HTML,
                'noclean' => false,
        );
        return $filtermanager->filter_text($text, $PAGE->context, $filteroptions, $skipfilters);
    }

    public function test_filter_normal() {
        $this->resetAfterTest();
        filter_set_global_state('emoticon', TEXTFILTER_ON);
        $this->assertRegExp('~^<p><img class="icon emoticon" alt="smile" title="smile" src="https://www.example.com/moodle/theme/image.php/_s/boost/core/1/s/smiley" /></p>$~',
                $this->filter_text('<p>:-)</p>', array()));
    }

    public function test_one_filter_disabled() {
        $this->resetAfterTest();
        filter_set_global_state('emoticon', TEXTFILTER_ON);
        $this->assertEquals('<p>:-)</p>',
                $this->filter_text('<p>:-)</p>', array('emoticon')));
    }

    public function test_disabling_other_filter_does_not_break_it() {
        $this->resetAfterTest();
        filter_set_global_state('emoticon', TEXTFILTER_ON);
        $this->assertRegExp('~^<p><img class="icon emoticon" alt="smile" title="smile" src="https://www.example.com/moodle/theme/image.php/_s/boost/core/1/s/smiley" /></p>$~',
                $this->filter_text('<p>:-)</p>', array('urltolink')));
    }

    public function test_one_filter_of_two_disabled() {
        $this->resetAfterTest();
        filter_set_global_state('emoticon', TEXTFILTER_ON);
        filter_set_global_state('urltolink', TEXTFILTER_ON);
        $this->assertRegExp('~^<p><img class="icon emoticon" alt="smile" title="smile" src="https://www.example.com/moodle/theme/image.php/_s/boost/core/1/s/smiley" /> http://google.com/</p>$~',
                $this->filter_text('<p>:-) http://google.com/</p>', array('glossary', 'urltolink')));
    }
}
