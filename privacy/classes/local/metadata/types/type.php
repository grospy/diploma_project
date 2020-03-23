<?php
//

/**
 * The base type interface which encapsulates a set of data held by a component with Moodle.
 *
 * @package core_privacy
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\metadata\types;

defined('MOODLE_INTERNAL') || die();

/**
 * The base type interface which all metadata types must implement.
 *
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @package core_privacy
 */
interface type {

    /**
     * Get the name describing this type.
     *
     * @return  string
     */
    public function get_name();

    /**
     * A list of the fields and their usage description.
     *
     * @return  array
     */
    public function get_privacy_fields();

    /**
     * A summary of what the metalink type is used for.
     *
     * @return string $summary
     */
    public function get_summary();
}
