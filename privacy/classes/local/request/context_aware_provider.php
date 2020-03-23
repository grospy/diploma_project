<?php
//

/**
 * File containing the provider interface for plugins needing access to all approved contexts to fill in relevant contextual data.
 *
 * Plugins should implement this if they need access to all approved contexts.
 *
 * @package core_privacy
 * @copyright 2018 Adrian Greeve <adriangreeve.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The provider interface for plugins which need access to all approved contexts to fill in relevant contextual data.
 *
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface context_aware_provider extends \core_privacy\local\request\core_data_provider {

    /**
     * Give the component a chance to include any contextual information deemed relevant to any child contexts which are
     * exporting personal data.
     *
     * By giving the component access to the full list of contexts being exported across all components, it can determine whether a
     * descendant context is being exported, and decide whether to add relevant contextual information about itself. Having access
     * to the full list of contexts being exported is what makes this component a context aware provider.
     *
     * @param  \core_privacy\local\request\contextlist_collection $contextcollection The collection of approved context lists.
     */
    public static function export_context_data(\core_privacy\local\request\contextlist_collection $contextcollection);
}
