<?php
//

/**
 * Excel data format writer
 *
 * @package    dataformat_excel
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace dataformat_excel;

defined('MOODLE_INTERNAL') || die();

/**
 * Excel data format writer
 *
 * @package    dataformat_excel
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class writer extends \core\dataformat\spout_base {

    /** @var $mimetype */
    protected $mimetype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

    /** @var $extension */
    protected $extension = ".xlsx";

    /** @var $spouttype */
    protected $spouttype = \Box\Spout\Common\Type::XLSX;

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

        // Replace any characters in the name that Excel cannot cope with.
        $title = strtr(trim($title, "'"), '[]*/\?:', '       ');
        // Shorten the title if necessary.
        $title = \core_text::substr($title, 0, 31);
        // After the substr, we might now have a single quote on the end.
        $title = trim($title, "'");

        $this->sheettitle = $title;
    }
}

