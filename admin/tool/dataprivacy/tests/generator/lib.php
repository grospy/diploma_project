<?php
//

/**
 * Data privacy tool data generator.
 *
 * @package    tool_dataprivacy
 * @category   test
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_dataprivacy\api;
use tool_dataprivacy\category;
use tool_dataprivacy\purpose;

defined('MOODLE_INTERNAL') || die();

/**
 * Data privacy tool data generator class.
 *
 * @package    tool_dataprivacy
 * @category   test
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_generator extends component_generator_base {

    /** @var int Number of created categories. */
    protected $categorycount = 0;

    /** @var int Number of created purposes. */
    protected $purposecount = 0;

    /**
     * Reset process.
     *
     * Do not call directly.
     *
     * @return void
     */
    public function reset() {
        $this->categorycount = 0;
        $this->purposecount = 0;
    }

    /**
     * Create a new category.
     *
     * @param array|stdClass $record
     * @return category
     */
    public function create_category($record = null) {
        $this->categorycount++;
        $i = $this->categorycount;
        $record = (object)$record;

        if (!isset($record->name)) {
            $record->name = "Test purpose $i";
        }

        if (!isset($record->description)) {
            $record->description = "{$record->name} description";
        }

        $category = api::create_category($record);

        return $category;
    }

    /**
     * Create a new purpose.
     *
     * @param array|stdClass $record
     * @return purpose
     */
    public function create_purpose($record = null) {
        $this->purposecount++;
        $i = $this->purposecount;
        $record = (object)$record;

        if (!isset($record->name)) {
            $record->name = "Test purpose $i";
        }

        if (!isset($record->description)) {
            $record->description = "{$record->name} $i description";
        }

        if (!isset($record->retentionperiod)) {
            $record->retentionperiod = 'PT1M';
        }

        if (!isset($record->lawfulbases)) {
            $record->lawfulbases = 'gdpr_art_6_1_a';
        }

        $purpose = api::create_purpose($record);

        return $purpose;
    }
}
