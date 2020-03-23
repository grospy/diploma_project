<?php
//

/**
 * This file contains the interface required to observe failures in the manager.
 *
 * @package core_privacy
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * The interface for a Manager observer.
 *
 * @package core_privacy
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface manager_observer {

    /**
     * Handle failure of a component.
     *
     * @param \Throwable $e
     * @param string $component
     * @param string $interface
     * @param string $methodname
     * @param array $params
     */
    public function handle_component_failure($e, $component, $interface, $methodname, array $params);
}
