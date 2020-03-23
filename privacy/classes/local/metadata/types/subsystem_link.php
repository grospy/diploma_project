<?php
//

/**
 * This file defines a link to another Moodle subsystem.
 *
 * @package core_privacy
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\metadata\types;

defined('MOODLE_INTERNAL') || die();

/**
 * The subsystem link type.
 *
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class subsystem_link implements type {

    /**
     * @var The name of the core subsystem to link.
     */
    protected $name;

    /**
     * @var array The list of data names and descriptions.
     */
    protected $privacyfields;

    /**
     * @var string A description of what this subsystem is used to store.
     */
    protected $summary;

    /**
     * Constructor for the subsystem_link.
     *
     * @param   string  $name The name of the subsystem to link.
     * @param   array   $privacyfields An optional array of fields and their descriptions.
     * @param   string  $summary A description of what is stored within this subsystem.
     */
    public function __construct($name, array $privacyfields = [], $summary = '') {
        if (debugging('', DEBUG_DEVELOPER)) {
            $teststring = clean_param($summary, PARAM_STRINGID);
            if ($teststring !== $summary) {
                debugging("Summary information for use of the '{$name}' subsystem " .
                    "has an invalid langstring identifier: '{$summary}'",
                    DEBUG_DEVELOPER);
            }
        }

        $this->name = $name;
        $this->privacyfields = $privacyfields;
        $this->summary = $summary;
    }

    /**
     * Function to return the name of this subsystem_link type.
     *
     * @return string $name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * A subsystem link does not define any fields itself.
     *
     * @return  array
     */
    public function get_privacy_fields() : array {
        return $this->privacyfields;
    }

    /**
     * A summary of what this subsystem is used for.
     *
     * @return string $summary
     */
    public function get_summary() {
        return $this->summary;
    }
}
