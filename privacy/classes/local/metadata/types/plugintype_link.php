<?php
//

/**
 * This file defines a link to another Moodle plugin.
 *
 * @package core_privacy
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\metadata\types;

defined('MOODLE_INTERNAL') || die();

/**
 * The plugintype link.
 *
 * @copyright 2018 Zig Tan <zig@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugintype_link implements type {

    /**
     * @var The name of the core plugintype to link.
     */
    protected $name;

    /**
     * @var array The list of data names and descriptions.
     */
    protected $privacyfields;

    /**
     * @var string A description of what this plugintype is used to store.
     */
    protected $summary;

    /**
     * Constructor for the plugintype_link.
     *
     * @param   string  $name The name of the plugintype to link.
     * @param   string  $summary A description of what is stored within this plugintype.
     */
    public function __construct($name, $privacyfields = [], $summary = '') {
        if (debugging('', DEBUG_DEVELOPER)) {
            $teststring = clean_param($summary, PARAM_STRINGID);
            if ($teststring !== $summary) {
                debugging("Summary information for use of the '{$name}' plugintype " .
                    "has an invalid langstring identifier: '{$summary}'",
                    DEBUG_DEVELOPER);
            }
        }

        $this->name = $name;
        $this->privacyfields = $privacyfields;
        $this->summary = $summary;
    }

    /**
     * Function to return the name of this plugintype_link type.
     *
     * @return string $name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * A plugintype link does not define any fields itself.
     *
     * @return  array
     */
    public function get_privacy_fields() : array {
        return $this->privacyfields;
    }

    /**
     * A summary of what this plugintype is used for.
     *
     * @return string $summary
     */
    public function get_summary() {
        return $this->summary;
    }
}
