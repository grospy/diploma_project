<?php
//

/**
 * An implementation of a userlist which has been filtered and approved.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * An implementation of a userlist which has been filtered and approved.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class approved_userlist extends userlist_base {

    /**
     * Create a new approved userlist.
     *
     * @param   \context        $context The context.
     * @param   string          $component the frankenstyle component name.
     * @param   \int[]          $userids The list of userids present in this list.
     */
    public function __construct(\context $context, string $component, array $userids) {
        parent::__construct($context, $component);

        $this->set_userids($userids);
    }

    /**
     * Create an approved userlist from a userlist.
     *
     * @param   userlist        $userlist The source list
     * @return  approved_userlist   The newly created approved userlist.
     */
    public static function create_from_userlist(userlist $userlist) : approved_userlist {
        $newlist = new static($userlist->get_context(), $userlist->get_component(), $userlist->get_userids());

        return $newlist;
    }
}
