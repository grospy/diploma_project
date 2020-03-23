<?php
//

/**
 * H5P factory class.
 * This class is used to decouple the construction of H5P related objects.
 *
 * @package    core_h5p
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_h5p;

defined('MOODLE_INTERNAL') || die();

use \core_h5p\framework as framework;
use \core_h5p\core as core;
use \H5PStorage as storage;
use \H5PValidator as validator;
use \H5PContentValidator as content_validator;

/**
 * H5P factory class.
 * This class is used to decouple the construction of H5P related objects.
 *
 * @package    core_h5p
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class factory {

    /** @var \core_h5p\core The Moodle H5PCore implementation */
    protected $core;

    /** @var \core_h5p\framework The Moodle H5PFramework implementation */
    protected $framework;

    /** @var \core_h5p\file_storage The Moodle H5PStorage implementation */
    protected $storage;

    /** @var validator The Moodle H5PValidator implementation */
    protected $validator;

    /** @var content_validator The Moodle H5PContentValidator implementation */
    protected $content_validator;

    /**
     * factory constructor.
     */
    public function __construct() {
        // Loading classes we need from H5P third party library.
        autoloader::register();
    }

    /**
     * Returns an instance of the \core_h5p\framework class.
     *
     * @return \core_h5p\framework
     */
    public function get_framework(): framework {
        if (null === $this->framework) {
            $this->framework = new framework();
        }

        return $this->framework;
    }

    /**
     * Returns an instance of the \core_h5p\core class.
     *
     * @return \core_h5p\core
     */
    public function get_core(): core {
        if (null === $this->core) {
            $fs = new \core_h5p\file_storage();
            $language = \core_h5p\framework::get_language();
            $context = \context_system::instance();

            $url = \moodle_url::make_pluginfile_url($context->id, 'core_h5p', '', null,
                '', '')->out();

            $this->core = new core($this->get_framework(), $fs, $url, $language, true);
        }

        return $this->core;
    }

    /**
     * Returns an instance of the \H5PStorage class.
     *
     * @return \H5PStorage
     */
    public function get_storage(): storage {
        if (null === $this->storage) {
            $this->storage = new storage($this->get_framework(), $this->get_core());
        }

        return $this->storage;
    }

    /**
     * Returns an instance of the \H5PValidator class.
     *
     * @return \H5PValidator
     */
    public function get_validator(): validator {
        if (null === $this->validator) {
            $this->validator = new validator($this->get_framework(), $this->get_core());
        }

        return $this->validator;
    }

    /**
     * Returns an instance of the \H5PContentValidator class.
     *
     * @return \H5PContentValidator
     */
    public function get_content_validator(): content_validator {
        if (null === $this->content_validator) {
            $this->content_validator = new content_validator($this->get_framework(), $this->get_core());
        }

        return $this->content_validator;
    }
}
