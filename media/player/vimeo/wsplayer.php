<?php
//


/**
 * A script to embed vimeo videos via the site (so vimeo privacy restrictions by domain will work in the mobile app).
 *
 * The site is doing a double frame embedding:
 *  - First, the media player replaces the vimeo link with an iframe pointing to vimeo.
 *  - Second, the app replaces the previous iframe link with a link to this file that includes again the iframe to vimeo.
 *  Thanks to these changes, the video is embedded in a page in the site server so the privacy restrictions will work.
 *
 *  Note 1: Vimeo privacy restrictions seems to be based on the Referer HTTP header.
 *  Note 2: This script works even if the plugin is disabled (some users could be using the vimeo embedding code).
 *
 * @package    media_vimeo
 * @copyright  2017 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/webservice/lib.php');

$token = required_param('token', PARAM_ALPHANUM);
$video = required_param('video', PARAM_ALPHANUM);   // Video ids are numeric, but it's more solid to expect things like 00001.
$width = optional_param('width', 0, PARAM_INT);
$height = optional_param('height', 0, PARAM_INT);

// Authenticate the user.
$webservicelib = new webservice();
$webservicelib->authenticate_user($token);

if (empty($width) && empty($height)) {
    // Use the full page. The video will keep the ratio.
    $display = 'style="position:absolute; top:0; left:0; width:100%; height:100%;"';
} else {
    $display = "width=\"$width\" height=\"$height\"";
}

$output = <<<OET
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body style="margin:0; padding:0">
        <iframe src="https://player.vimeo.com/video/$video"
            $display frameborder="0"
            webkitallowfullscreen mozallowfullscreen allowfullscreen>
        </iframe>
    </body>
</html>
OET;
echo $output;
