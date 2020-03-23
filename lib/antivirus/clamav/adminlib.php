<?php
//

/**
 * ClamAV antivirus adminlib.
 *
 * @package    antivirus_clamav
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Admin setting for running, adds verification.
 *
 * @package    antivirus_clamav
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class antivirus_clamav_runningmethod_setting extends admin_setting_configselect {
    /**
     * Save a setting
     *
     * @param string $data
     * @return string empty or error string
     */
    public function write_setting($data) {
        $validated = $this->validate($data);
        if ($validated !== true) {
            return $validated;
        }
        return parent::write_setting($data);
    }

    /**
     * Validate data.
     *
     * This ensures that unix socket transport is supported by this system.
     *
     * @param string $data
     * @return mixed True on success, else error message.
     */
    public function validate($data) {
        if ($data === 'unixsocket') {
            $supportedtransports = stream_get_transports();
            if (!array_search('unix', $supportedtransports)) {
                return get_string('errornounixsocketssupported', 'antivirus_clamav');
            }
        }
        return true;
    }
}
/**
 * Admin setting for unix socket path, adds verification.
 *
 * @package    antivirus_clamav
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class antivirus_clamav_pathtounixsocket_setting extends admin_setting_configtext {
    /**
     * Validate data.
     *
     * This ensures that unix socket setting is correct and ClamAV is running.
     *
     * @param string $data
     * @return mixed True on success, else error message.
     */
    public function validate($data) {
        $result = parent::validate($data);
        if ($result !== true) {
            return $result;
        }
        $runningmethod = get_config('antivirus_clamav', 'runningmethod');
        if ($runningmethod === 'unixsocket') {
            $socket = stream_socket_client('unix://' . $data, $errno, $errstr, ANTIVIRUS_CLAMAV_SOCKET_TIMEOUT);
            if (!$socket) {
                return get_string('errorcantopensocket', 'antivirus_clamav', "$errstr ($errno)");
            } else {
                // Send PING query to ClamAV socket to check its running state.
                fwrite($socket, "nPING\n");
                $response = stream_get_line($socket, 4);
                fclose($socket);
                if ($response !== 'PONG') {
                    return get_string('errorclamavnoresponse', 'antivirus_clamav');
                }
            }
        }
        return true;
    }
}
