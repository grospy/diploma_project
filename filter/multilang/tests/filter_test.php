<?php
//

/**
 * Unit tests.
 *
 * @package filter_multilang
 * @category test
 * @copyright 2019 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Tests for filter_multilang.
 *
 * @copyright 2019 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_multilang_filter_testcase extends advanced_testcase {

    public function setUp() {
        parent::setUp();

        $this->resetAfterTest(true);

        // Enable glossary filter at top level.
        filter_set_global_state('multilang', TEXTFILTER_ON);
    }

    /**
     * Setup parent language relationship.
     *
     * @param string $child the child language, e.g. 'fr_ca'.
     * @param string $parent the parent language, e.g. 'fr'.
     */
    protected function setup_parent_language(string $child, string $parent) {
        global $CFG;

        $langfolder = $CFG->dataroot . '/lang/' . $child;
        check_dir_exists($langfolder);
        $langconfig = "<?php\n\$string['parentlanguage'] = '$parent';";
        file_put_contents($langfolder . '/langconfig.php', $langconfig);
    }

    /**
     * Data provider for multi-language filtering tests.
     */
    public function multilang_testcases() {
        return [
            'Basic case EN' => [
                'English',
                '<span lang="en" class="multilang">English</span><span lang="fr" class="multilang">Français</span>',
                'en',
            ],
            'Basic case FR' => [
                'Français',
                '<span lang="en" class="multilang">English</span><span lang="fr" class="multilang">Français</span>',
                'fr',
            ],
            'Reversed input order EN' => [
                'English',
                '<span lang="fr" class="multilang">Français</span><span class="multilang" lang="en">English</span>',
                'en',
            ],
            'Reversed input order EN' => [
                'Français',
                '<span lang="fr" class="multilang">Français</span><span class="multilang" lang="en">English</span>',
                'fr',
            ],
            'Fallback to parent when child not present' => [
                'Français',
                '<span lang="en" class="multilang">English</span><span lang="fr" class="multilang">Français</span>',
                'fr_ca', ['fr_ca' => 'fr']
            ],
            'Both parent and child language present, using child' => [
                'Québécois',
                '<span lang="fr_ca" class="multilang">Québécois</span>
                <span lang="fr" class="multilang">Français</span>
                <span lang="en" class="multilang">English</span>',
                'fr_ca', ['fr_ca' => 'fr'],
            ],
            'Both parent and child language present, using parent' => [
                'Français',
                '<span lang="fr_ca" class="multilang">Québécois</span>
                <span lang="fr" class="multilang">Français</span>
                <span lang="en" class="multilang">English</span>',
                'fr', ['fr_ca' => 'fr'],
            ],
            'Both parent and child language present - reverse order, using child' => [
                'Québécois',
                '<span lang="en" class="multilang">English</span>
                <span lang="fr" class="multilang">Français</span>
                <span lang="fr_ca" class="multilang">Québécois</span>',
                'fr_ca', ['fr_ca' => 'fr'],
            ],
            'Both parent and child language present - reverse order, using parent' => [
                'Français',
                '<span lang="en" class="multilang">English</span>
                <span lang="fr" class="multilang">Français</span>
                <span lang="fr_ca" class="multilang">Québécois</span>',
                'fr', ['fr_ca' => 'fr'],
            ],
            'Fallback to parent when child not present when parent is en' => [
                'English',
                '<span lang="de" class="multilang">Deutsch</span><span lang="en" class="multilang">English</span>',
                'en_us',
            ],
        ];
    }

    /**
     * Tests the filtering of multi-language strings.
     *
     * @dataProvider multilang_testcases
     *
     * @param string $expectedoutput The expected filter output.
     * @param string $input the input that is filtererd.
     * @param string $targetlang the laguage to set as the current languge .
     * @param array $parentlangs Array child lang => parent lang. E.g. ['es_co' => 'es', 'es_mx' => 'es'].
     */
    public function test_filtering($expectedoutput, $input, $targetlang, $parentlangs = []) {
        global $SESSION;
        $SESSION->forcelang = $targetlang;

        foreach ($parentlangs as $child => $parent) {
            $this->setup_parent_language($child, $parent);
        }

        $filtered = format_text($input, FORMAT_HTML, array('context' => context_system::instance()));
        $this->assertEquals($expectedoutput, $filtered);
    }
}
