<?php
//

/**
 * Test xmlize xml import.
 *
 * @package    core
 * @category   test
 * @copyright  2017 Kilian Singer {@link http://quantumtechnology.info}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/xmlize.php');

/**
 * This test compares library against the original xmlize XML importer.
 *
 * @copyright  2017 Kilian Singer {@link http://quantumtechnology.info}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_xmlize_testcase extends basic_testcase {
    /**
     * Test an XML import using a valid XML file.
     *
     * The test expected file was generated using the original xmlize
     * implentation found at https://github.com/rmccue/XMLize/blob/master/xmlize-php5.inc.
     */
    public function test_xmlimport_of_proper_file() {
        $xml = file_get_contents(__DIR__ . '/sample_questions.xml');
        $serialised = file_get_contents(__DIR__ . '/sample_questions.ser');
        $this->assertEquals(unserialize($serialised), xmlize($xml));
    }

    /**
     * Test an XML import using invalid XML.
     */
    public function test_xmlimport_of_wrong_file() {
        $xml = file_get_contents(__DIR__ . '/sample_questions_wrong.xml');
        $this->expectException('xml_format_exception');
        $this->expectExceptionMessage('Error parsing XML: Mismatched tag at line 18, char 23');
        $xmlnew = xmlize($xml, 1, "UTF-8", true);
    }

    /**
     * Test an XML import using legacy question data with old image tag.
     */
    public function test_xmlimport_of_sample_question_with_old_image_tag() {
        $xml = file_get_contents(__DIR__ . '/sample_questions_with_old_image_tag.xml');
        $serialised = file_get_contents(__DIR__ . '/sample_questions_with_old_image_tag.ser');

        // Compare the legacy representation in its serialized state and after unserialization.
        $this->assertEquals($serialised, serialize(xmlize($xml)));
        $this->assertEquals(unserialize($serialised), xmlize($xml));
    }
}
