<?php
//

/**
 * Fixture for testing the functionality of core_h5p.
 *
 * @package     core
 * @subpackage  fixtures
 * @category    test
 * @copyright   2019 Victor Deniz <victor@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_h5p;

defined('MOODLE_INTERNAL') || die();

/**
 * H5P factory class stub for testing purposes.
 *
 * This class extends the real one to return the H5P core class stub.
 *
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class h5p_test_factory extends factory {
    /**
     * Returns an instance of the \core_h5p\core stub class.
     *
     * @return core_h5p\core
     */
    public function get_core(): core {
        if ($this->core === null ) {
            $fs = new file_storage();
            $language = framework::get_language();
            $context = \context_system::instance();

            $url = \moodle_url::make_pluginfile_url($context->id, 'core_h5p', '', null,
                '', '')->out();

            $this->core = new h5p_test_core($this->get_framework(), $fs, $url, $language, true);
        }

        return $this->core;
    }
}

/**
 * H5P core class stub for testing purposes.
 *
 * Modifies get_api_endpoint method to use local URLs.
 *
 * @copyright   2019 Victor Deniz <victor@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class h5p_test_core extends core {
    /** @var $endpoint Endpoint URL for testing H5P API */
    protected $endpoint;

    /**
     * Set the endpoint URL
     *
     * @param string $url Endpoint URL
     * @return void
     */
    public function set_endpoint($url): void {
        $this->endpoint = $url;
    }

    /**
     * Get the URL of the test endpoints instead of the H5P ones.
     *
     * If $library is null, moodle_url is the endpoint of the json test file with the H5P content types definition. If library is
     * the machine name of a content type, moodle_url is the test URL for downloading the content type file.
     *
     * @param string|null $library The filename of the H5P content type file in external.
     * @return \moodle_url The moodle_url of the file in external.
     */
    public function get_api_endpoint(?string $library): \moodle_url {

        if ($library) {
            $h5purl = $this->endpoint . '/' . $library . '.h5p';
        } else {
            $h5purl = $h5purl = $this->endpoint . '/h5pcontenttypes.json';
        }

        return new \moodle_url($h5purl);
    }
}