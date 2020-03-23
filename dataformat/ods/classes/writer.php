<?php
//

/**
 * ODS data format writer
 *
 * @package    dataformat_ods
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace dataformat_ods;

defined('MOODLE_INTERNAL') || die();

/**
 * ODS data format writer
 *
 * @package    dataformat_ods
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class writer extends \core\dataformat\spout_base {

    /** @var $mimetype */
    protected $mimetype = "application/vnd.oasis.opendocument.spreadsheet";

    /** @var $extension */
    protected $extension = ".ods";

    /** @var $spouttype */
    protected $spouttype = \Box\Spout\Common\Type::ODS;

    /**
     * Set the title of the worksheet inside a spreadsheet
     *
     * For some formats this will be ignored.
     *
     * @param string $title
     */
    public function set_sheettitle($title) {
        if (!$title) {
            return;
        }

        // Replace any characters in the name that ODS cannot cope with.
        $title = strtr(trim($title, "'"), '[]*/\?:', '       ');
        // Shorten the title if necessary.
        $title = \core_text::substr($title, 0, 31);
        // After the substr, we might now have a single quote on the end.
        $title = trim($title, "'");

        $this->sheettitle = $title;
    }
}

