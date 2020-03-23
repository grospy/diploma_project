<?php
//

/**
 * H5P Autoloader.
 *
 * @package    core_h5p
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_h5p;

defined('MOODLE_INTERNAL') || die();

/**
 * H5P Autoloader.
 *
 * @package    core_h5p
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class autoloader {
    public static function register(): void {
        spl_autoload_register([self::class, 'autoload']);
    }

    public static function autoload($classname): void {
        global $CFG;

        $classes = [
            'H5PCore' => '/lib/h5p/h5p.classes.php',
            'H5PHubEndpoints' => '/lib/h5p/h5p.classes.php',
            'H5PFrameworkInterface' => '/lib/h5p/h5p.classes.php',
            'H5PContentValidator' => 'lib/h5p/h5p.classes.php',
            'H5PValidator' => '/lib/h5p/h5p.classes.php',
            'H5PStorage' => '/lib/h5p/h5p.classes.php',
            'H5PDevelopment' => '/lib/h5p/h5p-development.class.php',
            'H5PFileStorage' => '/lib/h5p/h5p-file-storage.interface.php',
            'H5PMetadata' => '/lib/h5p/h5p-metadata.class.php',
        ];

        if (isset($classes[$classname])) {
            require_once("{$CFG->dirroot}{$classes[$classname]}");
        }
    }
}
