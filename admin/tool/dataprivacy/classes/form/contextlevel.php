<?php
//

/**
 * This file contains the form add/update context level data.
 *
 * @package   tool_dataprivacy
 * @copyright 2018 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy\form;
defined('MOODLE_INTERNAL') || die();

use core\form\persistent;
use tool_dataprivacy\api;
use tool_dataprivacy\data_registry;

/**
 * Context level data form.
 *
 * @package   tool_dataprivacy
 * @copyright 2018 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class contextlevel extends context_instance {

    /**
     * @var The persistent class.
     */
    protected static $persistentclass = 'tool_dataprivacy\\contextlevel';

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        $this->_form->setDisableShortforms();

        $this->_form->addElement('header', 'contextlevelname', $this->_customdata['contextlevelname']);

        $this->add_purpose_category();

        $this->_form->addElement('hidden', 'contextlevel');
        $this->_form->setType('contextlevel', PARAM_INT);

        parent::add_action_buttons(false, get_string('savechanges'));
    }

    /**
     * Returns the customdata array for the provided context level.
     *
     * @param int $contextlevel
     * @return array
     */
    public static function get_contextlevel_customdata($contextlevel) {

        $persistent = \tool_dataprivacy\contextlevel::get_record_by_contextlevel($contextlevel, false);
        if (!$persistent) {
            $persistent = new \tool_dataprivacy\contextlevel();
            $persistent->set('contextlevel', $contextlevel);
        }

        $includeinherit = true;
        if ($contextlevel == CONTEXT_SYSTEM) {
            // Nothing to inherit from Site level.
            $includeinherit = false;
        }
        $includenotset = true;
        if ($contextlevel == CONTEXT_SYSTEM || $contextlevel == CONTEXT_USER) {
            // No 'not set' value for system and user because we do not have defaults for them.
            $includenotset = false;
        }
        $purposeoptions = \tool_dataprivacy\output\data_registry_page::purpose_options(
            api::get_purposes(), $includenotset, $includeinherit);
        $categoryoptions = \tool_dataprivacy\output\data_registry_page::category_options(
            api::get_categories(), $includenotset, $includeinherit);

        $customdata = [
            'contextlevel' => $contextlevel,
            'contextlevelname' => get_string('contextlevelname' . $contextlevel, 'tool_dataprivacy'),
            'persistent' => $persistent,
            'purposes' => $purposeoptions,
            'categories' => $categoryoptions,
        ];

        $effectivepurpose = api::get_effective_contextlevel_purpose($contextlevel);
        if ($effectivepurpose) {

            $customdata['currentretentionperiod'] = self::get_retention_display_text($effectivepurpose, $contextlevel,
                \context_system::instance());

            $customdata['purposeretentionperiods'] = [];
            foreach ($purposeoptions as $optionvalue => $unused) {

                // Get the effective purpose if $optionvalue would be the selected value.
                list($purposeid, $unused) = data_registry::get_effective_default_contextlevel_purpose_and_category($contextlevel,
                    $optionvalue);
                $purpose = new \tool_dataprivacy\purpose($purposeid);

                $retentionperiod = self::get_retention_display_text(
                    $purpose,
                    $contextlevel,
                    \context_system::instance()
                );
                $customdata['purposeretentionperiods'][$optionvalue] = $retentionperiod;
            }
        }

        return $customdata;
    }
}
