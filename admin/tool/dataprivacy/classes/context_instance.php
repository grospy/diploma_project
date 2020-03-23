<?php
//

/**
 * Class for loading/storing context instances data from the DB.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_dataprivacy;
defined('MOODLE_INTERNAL') || die();

/**
 * Class for loading/storing context instances data from the DB.
 *
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class context_instance extends \core\persistent {

    /**
     * Database table.
     */
    const TABLE = 'tool_dataprivacy_ctxinstance';

    /**
     * Not set value.
     */
    const NOTSET = 0;

    /**
     * Inherit value.
     */
    const INHERIT = -1;

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'contextid' => array(
                'type' => PARAM_INT,
                'description' => 'The context id.',
            ),
            'purposeid' => array(
                'type' => PARAM_INT,
                'description' => 'The purpose id.',
                'null' => NULL_ALLOWED,
            ),
            'categoryid' => array(
                'type' => PARAM_INT,
                'description' => 'The category id.',
                'null' => NULL_ALLOWED,
            ),
        );
    }

    /**
     * Returns an instance by contextid.
     *
     * @param mixed $contextid
     * @param mixed $exception
     * @return null
     */
    public static function get_record_by_contextid($contextid, $exception = true) {
        global $DB;

        if (!$record = $DB->get_record(self::TABLE, array('contextid' => $contextid))) {
            if (!$exception) {
                return false;
            } else {
                throw new \dml_missing_record_exception(self::TABLE);
            }
        }

        return new static(0, $record);
    }

    /**
     * Is the provided purpose used by any context instance?
     *
     * @param int $purposeid
     * @return bool
     */
    public static function is_purpose_used($purposeid) {
        global $DB;
        return $DB->record_exists(self::TABLE, array('purposeid' => $purposeid));
    }

    /**
     * Is the provided category used by any context instance?
     *
     * @param int $categoryid
     * @return bool
     */
    public static function is_category_used($categoryid) {
        global $DB;
        return $DB->record_exists(self::TABLE, array('categoryid' => $categoryid));
    }
}
