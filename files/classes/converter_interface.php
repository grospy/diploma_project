<?php
//

/**
 * Class for converting files between different file formats.
 *
 * @package    core_files
 * @copyright  2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_files;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for converting files between different file formats.
 *
 * @package    docconvert_unoconv
 * @copyright  2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface converter_interface {

    /**
     * Whether the plugin is configured and requirements are met.
     *
     * Note: This function may be called frequently and caching is advisable.
     *
     * @return  bool
     */
    public static function are_requirements_met();

    /**
     * Convert a document to a new format and return a conversion object relating to the conversion in progress.
     *
     * @param   conversion $conversion The file to be converted
     * @return  $this
     */
    public function start_document_conversion(conversion $conversion);

    /**
     * Poll an existing conversion for status update.
     *
     * @param   conversion $conversion The file to be converted
     * @return  $this
     */
    public function poll_conversion_status(conversion $conversion);

    /**
     * Determine whether a conversion between the two supplied formats is achievable.
     *
     * Note: This function may be called frequently and caching is advisable.
     *
     * @param   string $from The source type
     * @param   string $to The destination type
     * @return  bool
     */
    public static function supports($from, $to);

    /**
     * A list of the supported conversions.
     *
     * Note: This information is only displayed to administrators.
     *
     * @return  string
     */
    public function get_supported_conversions();
}
