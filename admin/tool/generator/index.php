<?php
//

/**
 * Development data generator.
 *
 * @package    tool_generator
 * @copyright  2009 Nicolas Connault
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(__DIR__ . '/../../../config.php');

// This index page was previously in use, for now we redirect to the make test
// course page - but we might reinstate this page in the future.
redirect(new moodle_url('/admin/tool/generator/maketestcourse.php'));
