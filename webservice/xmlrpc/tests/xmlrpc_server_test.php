<?php
//

/**
 * Unit tests for the XML-RPC web service server.
 *
 * @package    webservice_xmlrpc
 * @category   test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/webservice/xmlrpc/locallib.php');

/**
 * Unit tests for the XML-RPC web service server.
 *
 * @package    webservice_xmlrpc
 * @category   test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class xmlrpc_server_test extends advanced_testcase {

    /**
     * Setup.
     */
    public function setUp() {
        if (!function_exists('xmlrpc_decode')) {
            $this->markTestSkipped('XMLRPC is not installed.');
        }
    }

    /**
     * Test parameter parsing.
     *
     * @dataProvider parse_request_provider
     * @param string $input             The XML-RPC request
     * @param string $expectfunction    The expected value for the function after decoding the request
     * @param array  $expectparams      The expected value for the params after decoding the request
     */
    public function test_parse_request($input, $expectfunction, $expectparams) {
        $server = $this->getMockBuilder('\webservice_xmlrpc_server')
                       ->setMethods(['fetch_input_content'])
                       ->disableOriginalConstructor()
                       ->getMock();

        $server->method('fetch_input_content')
               ->willReturn($input);

        $rc = new \ReflectionClass('\webservice_xmlrpc_server');
        $rcm = $rc->getMethod('parse_request');
        $rcm->setAccessible(true);
        $rcm->invoke($server);

        $rcp = $rc->getProperty('functionname');
        $rcp->setAccessible(true);
        $this->assertEquals($expectfunction, $rcp->getValue($server));

        $rcp = $rc->getProperty('parameters');
        $rcp->setAccessible(true);
        $this->assertEquals($expectparams, $rcp->getValue($server));
    }

    /**
     * Data provider for testing parse_request.
     *
     * @return array
     */
    public function parse_request_provider() {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';

        // This valid webservice call has one required param ('component'), and one optional param ('lang').
        $validmethod = '<methodName>core_get_component_strings</methodName>';
        $requiredparams = '<params><param><value><string>moodle</string></value></param></params>';
        $allparams = '<params><param><value><string>moodle</string></value></param><param><value><string>en</string></value>'
                . '</param></params>';
        $requiredparamsnonlatin = '<params><param><value><string>ᛞᛁᛞᛃᛟᚢᚲᚾᛟᚹᛈᚺᛈᛋᚢᛈᛈᛟᚱᛏᛋᚢᛏᚠ8ᚡᚨᚱᛁᚨᛒᛚᛖᚾᚨᛗᛖᛋ</string></value></param></params>';

        return [
                'Valid method, required params only' => [
                    "{$xml}<methodCall>{$validmethod}{$requiredparams}</methodCall>",
                    'core_get_component_strings',
                    ['component' => 'moodle'],
                ],
                'Valid method, all params' => [
                    "{$xml}<methodCall>{$validmethod}{$allparams}</methodCall>",
                    'core_get_component_strings',
                    ['component' => 'moodle', 'lang' => 'en'],
                ],
                'Valid method required params only (non Latin)' => [
                    "{$xml}<methodCall>{$validmethod}{$requiredparamsnonlatin}</methodCall>",
                    'core_get_component_strings',
                    ['component' => 'ᛞᛁᛞᛃᛟᚢᚲᚾᛟᚹᛈᚺᛈᛋᚢᛈᛈᛟᚱᛏᛋᚢᛏᚠ8ᚡᚨᚱᛁᚨᛒᛚᛖᚾᚨᛗᛖᛋ'],
                ],
            ];
    }
}
