<?php
//

/**
 * Issued badge renderable.
 *
 * @package    core
 * @subpackage badges
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

namespace core_badges\output;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/badgeslib.php');

use renderable;

/**
 * Badge recipients rendering class
 *
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_recipients implements renderable {

    /** @var string how are the data sorted */
    public $sort = 'lastname';

    /** @var string how are the data sorted */
    public $dir = 'ASC';

    /** @var int page number to display */
    public $page = 0;

    /** @var int number of badge recipients to display per page */
    public $perpage = 30;

    /** @var int the total number or badge recipients to display */
    public $totalcount = null;

    /** @var array internal list of  badge recipients ids */
    public $userids = array();

    /**
     * Initializes the list of users to display
     *
     * @param array $holders List of badge holders
     */
    public function __construct($holders) {
        $this->userids = $holders;
    }
}

