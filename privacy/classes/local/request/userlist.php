<?php
//

/**
 * List of users from the Privacy API Search functions.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * List of users from the Privacy API Search functions.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class userlist extends userlist_base {

    /**
     * Add a set of users from  SQL.
     *
     * The SQL should only return a list of user IDs.
     *
     * @param   string  $fieldname The name of the field which holds the user id
     * @param   string  $sql    The SQL which will fetch the list of * user IDs
     * @param   array   $params The set of SQL parameters
     * @return  $this
     */
    public function add_from_sql(string $fieldname, string $sql, array $params) : userlist {
        global $DB;

        // Able to guess a field name.
        $wrapper = "
            SELECT DISTINCT u.id
            FROM {user} u
            JOIN ({$sql}) target ON u.id = target.{$fieldname}";

        $users = $DB->get_records_sql($wrapper, $params);
        $this->add_userids(array_keys($users));

        return $this;
    }

    /**
     * Adds the user user for a given user.
     *
     * @param   int     $userid
     * @return  $this
     */
    public function add_user(int $userid) : userlist {
        $this->add_users([$userid]);

        return $this;
    }

    /**
     * Adds the user users for given users.
     *
     * @param   int[]   $userids
     * @return  $this
     */
    public function add_users(array $userids) : userlist {
        global $DB;

        if (!empty($userids)) {
            list($useridsql, $useridparams) = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
            $sql = "SELECT DISTINCT u.id
                      FROM {user} u
                     WHERE u.id {$useridsql}";
            $this->add_from_sql('id', $sql, $useridparams);
        }
        return $this;
    }

    /**
     * Sets the component for this userlist.
     *
     * @param   string  $component the frankenstyle component name.
     * @return  $this
     */
    public function set_component($component) : userlist_base {
        parent::set_component($component);

        return $this;
    }
}
