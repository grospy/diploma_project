<?php
//

/**
 * Expired data requests tests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_dataprivacy\api;
use tool_dataprivacy\category;
use tool_dataprivacy\data_request;
use tool_dataprivacy\purpose;

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once('data_privacy_testcase.php');

/**
 * Expired data requests tests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_expired_data_requests_testcase extends data_privacy_testcase {

    /**
     * Test tearDown.
     */
    public function tearDown() {
        \core_privacy\local\request\writer::reset();
    }

    /**
     * Test finding and deleting expired data requests
     */
    public function test_data_request_expiry() {
        global $DB;
        $this->resetAfterTest();
        \core_privacy\local\request\writer::setup_real_writer_instance();

        // Set up test users.
        $this->setAdminUser();
        $studentuser = $this->getDataGenerator()->create_user();
        $studentusercontext = context_user::instance($studentuser->id);

        $dpouser = $this->getDataGenerator()->create_user();
        $this->assign_site_dpo($dpouser);

        // Set site purpose.
        $this->create_system_purpose();

        // Set request expiry to 5 minutes.
        set_config('privacyrequestexpiry', 300, 'tool_dataprivacy');

        // Create and approve data request.
        $this->setUser($studentuser->id);
        $datarequest = api::create_data_request($studentuser->id, api::DATAREQUEST_TYPE_EXPORT);
        $requestid = $datarequest->get('id');
        $this->setAdminUser();
        api::approve_data_request($requestid);
        $this->setUser();
        ob_start();
        $this->runAdhocTasks('\tool_dataprivacy\task\process_data_request_task');
        ob_end_clean();

        // Confirm approved and exported.
        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_DOWNLOAD_READY, $request->get('status'));
        $fileconditions = array(
            'userid' => $studentuser->id,
            'component' => 'tool_dataprivacy',
            'filearea' => 'export',
            'itemid' => $requestid,
            'contextid' => $studentusercontext->id,
        );
        $this->assertEquals(2, $DB->count_records('files', $fileconditions));

        // Run expiry deletion - should not affect test export.
        $expiredrequests = data_request::get_expired_requests();
        $this->assertEquals(0, count($expiredrequests));
        data_request::expire($expiredrequests);

        // Confirm test export was not deleted.
        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_DOWNLOAD_READY, $request->get('status'));
        $this->assertEquals(2, $DB->count_records('files', $fileconditions));

        // Change request expiry to 1 second and allow it to elapse.
        set_config('privacyrequestexpiry', 1, 'tool_dataprivacy');
        $this->waitForSecond();

        // Re-run expiry deletion, confirm the request expires and export is deleted.
        $expiredrequests = data_request::get_expired_requests();
        $this->assertEquals(1, count($expiredrequests));
        data_request::expire($expiredrequests);

        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_EXPIRED, $request->get('status'));
        $this->assertEquals(0, $DB->count_records('files', $fileconditions));
    }

    /**
     * Test for \tool_dataprivacy\data_request::is_expired()
     * Tests for the expected request status to protect from false positive/negative,
     * then tests is_expired() is returning the expected response.
     */
    public function test_is_expired() {
        $this->resetAfterTest();
        \core_privacy\local\request\writer::setup_real_writer_instance();

        // Set request expiry beyond this test.
        set_config('privacyrequestexpiry', 20, 'tool_dataprivacy');

        $admin = get_admin();
        $this->setAdminUser();

        // Set site purpose.
        $this->create_system_purpose();

        // Create export request.
        $datarequest = api::create_data_request($admin->id, api::DATAREQUEST_TYPE_EXPORT);
        $requestid = $datarequest->get('id');

        // Approve the request.
        ob_start();
        $this->setAdminUser();
        api::approve_data_request($requestid);
        $this->runAdhocTasks('\tool_dataprivacy\task\process_data_request_task');
        ob_end_clean();

        // Test Download ready (not expired) response.
        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_DOWNLOAD_READY, $request->get('status'));
        $result = data_request::is_expired($request);
        $this->assertFalse($result);

        // Let request expiry time lapse.
        set_config('privacyrequestexpiry', 1, 'tool_dataprivacy');
        $this->waitForSecond();

        // Test Download ready (time expired) response.
        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_DOWNLOAD_READY, $request->get('status'));
        $result = data_request::is_expired($request);
        $this->assertTrue($result);

        // Run the expiry task to properly expire the request.
        ob_start();
        $task = \core\task\manager::get_scheduled_task('\tool_dataprivacy\task\delete_expired_requests');
        $task->execute();
        ob_end_clean();

        // Test Expired response status response.
        $request = new data_request($requestid);
        $this->assertEquals(api::DATAREQUEST_STATUS_EXPIRED, $request->get('status'));
        $result = data_request::is_expired($request);
        $this->assertTrue($result);
    }

    /**
     * Create a site (system context) purpose and category.
     *
     * @return  void
     */
    protected function create_system_purpose() {
        $purpose = new purpose(0, (object) [
            'name' => 'Test purpose ' . rand(1, 1000),
            'retentionperiod' => 'P1D',
            'lawfulbases' => 'gdpr_art_6_1_a',
        ]);
        $purpose->create();

        $cat = new category(0, (object) ['name' => 'Test category']);
        $cat->create();

        $record = (object) [
            'purposeid'     => $purpose->get('id'),
            'categoryid'    => $cat->get('id'),
            'contextlevel'  => CONTEXT_SYSTEM,
        ];
        api::set_contextlevel($record);
    }
}
