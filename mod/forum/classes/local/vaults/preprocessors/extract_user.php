<?php
//

/**
 * Extract user vault preprocessor.
 *
 * @package    mod_forum
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\vaults\preprocessors;

defined('MOODLE_INTERNAL') || die();

use user_picture;

/**
 * Extract user vault preprocessor.
 *
 * Used to separate out the user record
 * from a list of DB records that have been joined on the user table.
 *
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class extract_user {
    /** @var string $idalias The alias for the id property of the user */
    private $idalias;
    /** @var string $alias The prefix used for each of the user properties */
    private $alias;

    /**
     * Constructor.
     *
     * @param string $idalias The alias for the id property of the user
     * @param string $alias The prefix used for each of the user properties
     */
    public function __construct(string $idalias, string $alias) {
        $this->idalias = $idalias;
        $this->alias = $alias;
    }

    /**
     * Extract the user records from a list of DB records.
     *
     * @param stdClass[] $records The DB records
     * @return stdClass[] The list of extracted users
     */
    public function execute(array $records) : array {
        $idalias = $this->idalias;
        $alias = $this->alias;

        return array_map(function($record) use ($idalias, $alias) {
            return user_picture::unalias($record, ['deleted'], $idalias, $alias);
        }, $records);
    }
}