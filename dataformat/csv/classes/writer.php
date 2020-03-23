<?php
//

/**
 * CSV data format writer
 *
 * @package    dataformat_csv
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace dataformat_csv;

defined('MOODLE_INTERNAL') || die();

/**
 * CSV data format writer
 *
 * @package    dataformat_csv
 * @copyright  2016 Brendan Heywood (brendan@catalyst-au.net)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class writer extends \core\dataformat\spout_base {

    /** @var $mimetype */
    protected $mimetype = "text/csv";

    /** @var $extension */
    protected $extension = ".csv";

    /** @var $spouttype */
    protected $spouttype = \Box\Spout\Common\Type::CSV;

}

