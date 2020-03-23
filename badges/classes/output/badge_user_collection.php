<?php
//

/**
 * Collection of use badges.
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
 * Collection of user badges used at the mybadges.php page
 *
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_user_collection extends badge_collection implements renderable {
    /** @var array backpack settings */
    public $backpack = null;

    /** @var string search */
    public $search = '';

    /**
     * Initializes user badge collection.
     *
     * @param array $badges Badges to render
     * @param int $userid Badges owner
     */
    public function __construct($badges, $userid) {
        global $CFG;
        parent::__construct($badges);

        if (!empty($CFG->badges_allowexternalbackpack)) {
            $this->backpack = get_backpack_settings($userid, true);
        }
    }
}

