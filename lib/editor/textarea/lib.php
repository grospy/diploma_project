<?php

//

/**
 * Failsafe textarea editor support.
 *
 * @package    editor
 * @subpackage textarea
 * @copyright  2009 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class textarea_texteditor extends texteditor {
    public function supported_by_browser() {
        return true;
    }

    public function get_supported_formats() {
        return array(FORMAT_HTML     => FORMAT_HTML,
                     FORMAT_MOODLE   => FORMAT_MOODLE,
                     FORMAT_PLAIN    => FORMAT_PLAIN,
                     FORMAT_MARKDOWN => FORMAT_MARKDOWN,
                    );
    }

    public function get_preferred_format() {
        return FORMAT_MOODLE;
    }

    public function supports_repositories() {
        return true;
    }

    public function use_editor($elementid, array $options=null, $fpoptions=null) {
        return;
    }
}


