<?php
//

/**
 * Tests for servicelib.php
 *
 * @package   mod_lti
 * @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/mod/lti/servicelib.php');

/**
 * Tests for servicelib.php
 *
 * @package   mod_lti
 * @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_lti_servicelib_testcase extends basic_testcase {
    /**
     * Test that lti_parse_message_id never fails with good and bad XML.
     *
     * @dataProvider message_id_provider
     * @param mixed $expected Expected message ID.
     * @param string $xml XML to parse.
     */
    public function test_lti_parse_message_id($expected, $xml) {
        $xml = simplexml_load_string($xml);
        $this->assertEquals($expected, lti_parse_message_id($xml));
    }

    /**
     * Test data provider for testing lti_parse_message_id
     *
     * @return array
     */
    public function message_id_provider() {
        $valid = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
    <imsx_POXHeader>
        <imsx_POXRequestHeaderInfo>
            <imsx_version>V1.0</imsx_version>
            <imsx_messageIdentifier>9999</imsx_messageIdentifier>
        </imsx_POXRequestHeaderInfo>
    </imsx_POXHeader>
    <imsx_POXBody/>
</imsx_POXEnvelopeRequest>
XML;

        $noheader = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
    <badXmlHere>
        <imsx_POXRequestHeaderInfo>
            <imsx_version>V1.0</imsx_version>
            <imsx_messageIdentifier>9999</imsx_messageIdentifier>
        </imsx_POXRequestHeaderInfo>
    </badXmlHere>
    <imsx_POXBody/>
</imsx_POXEnvelopeRequest>
XML;

        $noinfo = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
    <imsx_POXHeader>
        <badXmlHere>
            <imsx_version>V1.0</imsx_version>
            <imsx_messageIdentifier>9999</imsx_messageIdentifier>
        </badXmlHere>
    </imsx_POXHeader>
    <imsx_POXBody/>
</imsx_POXEnvelopeRequest>
XML;

        $noidentifier = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
    <imsx_POXHeader>
        <imsx_POXRequestHeaderInfo>
            <imsx_version>V1.0</imsx_version>
        </imsx_POXRequestHeaderInfo>
    </imsx_POXHeader>
    <imsx_POXBody/>
</imsx_POXEnvelopeRequest>
XML;

        return array(
            array(9999, $valid),
            array('', $noheader),
            array('', $noinfo),
            array('', $noidentifier),
        );
    }
}