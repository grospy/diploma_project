<?php
//

/**
 * This file contains a controller for receiving LTI service requests
 *
 * @package    mod_lti
 * @copyright  2014 Vital Source Technologies http://vitalsource.com
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_DEBUG_DISPLAY', true);
define('NO_MOODLE_COOKIES', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');


$response = new \mod_lti\local\ltiservice\response();

$isget = $response->get_request_method() === mod_lti\local\ltiservice\resource_base::HTTP_GET;
$isdelete = $response->get_request_method() === mod_lti\local\ltiservice\resource_base::HTTP_DELETE;

if ($isget) {
    $response->set_accept(isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '');
} else {
    $response->set_content_type(isset($_SERVER['CONTENT_TYPE']) ? explode(';', $_SERVER['CONTENT_TYPE'], 2)[0] : '');
}

$ok = false;
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';

$accept = $response->get_accept();
$contenttype = $response->get_content_type();

$services = lti_get_services();
foreach ($services as $service) {
    $resources = $service->get_resources();
    foreach ($resources as $resource) {
        if (($isget && !empty($accept) && (strpos($accept, '*/*') === false) &&
             !in_array($accept, $resource->get_formats())) ||
            ((!$isget && !$isdelete) && !in_array($contenttype, $resource->get_formats()))) {
            continue;
        }
        $template = $resource->get_template();
        $template = preg_replace('/{config_type}/', '(toolproxy|tool)', $template);
        $template = preg_replace('/\{[a-zA-Z_]+\}/', '[^/]+', $template);
        $template = preg_replace('/\(([0-9a-zA-Z_\-,\/]+)\)/', '(\\1|)', $template);
        $template = str_replace('/', '\/', $template);
        if (preg_match("/^{$template}$/", $path) === 1) {
            $ok = true;
            break 2;
        }
    }
}
if (!$ok) {
    $response->set_code(400);
    $response->set_reason("No handler found for {$path} {$accept} {$contenttype}");
} else {
    $body = file_get_contents('php://input');
    $response->set_request_data($body);
    if (in_array($response->get_request_method(), $resource->get_methods())) {
        $resource->execute($response);
    } else {
        $response->set_code(405);
    }
}
$response->send();
