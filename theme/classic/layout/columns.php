<?php
//

/**
 * The columns layout for the classic theme.
 *
 * @package   theme_classic
 * @copyright 2018 Bas Brands
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes();
$blockspre = $OUTPUT->blocks('side-pre');
$blockspost = $OUTPUT->blocks('side-post');

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockspre,
    'sidepostblocks' => $blockspost,
    'haspreblocks' => $hassidepre,
    'haspostblocks' => $hassidepost,
    'bodyattributes' => $bodyattributes
];

echo $OUTPUT->render_from_template('theme_classic/columns', $templatecontext);

