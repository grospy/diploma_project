<?php
//

/**
 * List of enabled backpacks for the site.
 *
 * @package    core_badges
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\output;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/tablelib.php');
require_once($CFG->libdir . '/badgeslib.php');

use html_writer;
use moodle_url;
use table_sql;

/**
 * Backpacks table class.
 *
 * @package    core_badges
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external_backpacks_table extends table_sql {

    /**
     * Sets up the table.
     */
    public function __construct() {
        parent::__construct('backpacks');

        $this->context = \context_system::instance();
        // This object should not be used without the right permissions.
        require_capability('moodle/badges:manageglobalsettings', $this->context);

        // Define columns in the table.
        $this->define_table_columns();

        // Define configs.
        $this->define_table_configs();
    }

    /**
     * Setup the headers for the table.
     */
    protected function define_table_columns() {
        $cols = [
            'backpackweburl' => get_string('backpackurl', 'core_badges'),
            'sortorder' => '',
        ];

        $this->define_columns(array_keys($cols));
        $this->define_headers(array_values($cols));
    }

    /**
     * Define table configs.
     */
    protected function define_table_configs() {
        $this->collapsible(false);
        $this->sortable(false);
        $this->pageable(false);
    }

}
