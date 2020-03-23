<?php
//

/**
 * Steps definitions related to the SCORM activity module.
 *
 * @package    mod_scorm
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

use Behat\Behat\Hook\Scope\AfterScenarioScope;

/**
 * Steps definitions related to the SCORM activity module.
 *
 * @package    mod_scorm
 * @category   test
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_mod_scorm extends behat_base {

    /**
     * Restart the Seleium Session after each mod_scorm Scenario.
     *
     * This prevents issues with the scorm player's onbeforeunload event, and cached SCORM content being served to the
     * browser in subsequent tests.
     *
     * @AfterScenario @mod_scorm
     * @param AfterScenarioScope $scope The scenario scope
     */
    public function reset_after_scorm(AfterScenarioScope $scope) {
        $this->getSession()->stop();
    }
}
