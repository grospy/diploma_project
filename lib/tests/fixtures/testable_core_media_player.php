<?php
//

/**
 * Fixture for testing the functionality of core_media_player.
 *
 * @package     core
 * @subpackage  fixtures
 * @category    test
 * @copyright   2012 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Media player stub for testing purposes.
 *
 * @copyright   2012 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class media_test_plugin extends core_media_player {
    /** @var array Array of supported extensions */
    public $ext;
    /** @var int Player rank */
    public $rank;
    /** @var int Arbitrary number */
    public $num;

    /**
     * Constructor is used for tuning the fixture.
     *
     * @param int $num Number (used in output)
     * @param int $rank Player rank
     * @param array $ext Array of supported extensions
     */
    public function __construct($num = 1, $rank = 13, $ext = array('mp3', 'flv', 'f4v', 'mp4')) {
        $this->ext = $ext;
        $this->rank = $rank;
        $this->num = $num;
    }

    /**
     * Generates code required to embed the player.
     *
     * @param array $urls URLs of media files
     * @param string $name Display name; '' to use default
     * @param int $width Optional width; 0 to use default
     * @param int $height Optional height; 0 to use default
     * @param array $options Options array
     * @return string HTML code for embed
     */
    public function embed($urls, $name, $width, $height, $options) {
        self::pick_video_size($width, $height);
        $contents = "\ntestsource=". join("\ntestsource=", $urls) .
            "\ntestname=$name\ntestwidth=$width\ntestheight=$height\n<!--FALLBACK-->\n";
        return html_writer::span($contents, 'mediaplugin mediaplugin_test');
    }

    /**
     * Gets the list of file extensions supported by this media player.
     *
     * @return array Array of strings (extension not including dot e.g. '.mp3')
     */
    public function get_supported_extensions() {
        return $this->ext;
    }

    /**
     * Gets the ranking of this player.
     *
     * @return int Rank
     */
    public function get_rank() {
        return 10;
    }
}