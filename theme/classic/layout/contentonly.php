<?php
//

/**
 * A one column layout for the classic theme.
 *
 * @package   theme_classic
 * @copyright 2018 Bas Brands
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes([]);

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes
];

echo $OUTPUT->render_from_template('theme_classic/contentonly', $templatecontext);

