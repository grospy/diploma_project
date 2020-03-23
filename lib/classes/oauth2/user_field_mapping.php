<?php
//

/**
 * Class for loading/storing oauth2 endpoints from the DB.
 *
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\oauth2;

defined('MOODLE_INTERNAL') || die();

use core\persistent;
use lang_string;
/**
 * Class for loading/storing oauth2 user field mappings from the DB
 *
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_field_mapping extends persistent {

    const TABLE = 'oauth2_user_field_mapping';

    /**
     * Return the list of valid internal user fields.
     *
     * @return array
     */
    private static function get_user_fields() {
        return array_merge(\core_user::AUTHSYNCFIELDS, ['picture', 'username']);
    }

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'issuerid' => array(
                'type' => PARAM_INT
            ),
            'externalfield' => array(
                'type' => PARAM_RAW_TRIMMED,
            ),
            'internalfield' => array(
                'type' => PARAM_ALPHANUMEXT,
                'choices' => self::get_user_fields()
            )
        );
    }

    /**
     * Return the list of internal fields
     * in a format they can be used for choices in a select menu
     * @return array
     */
    public function get_internalfield_list() {
        return array_combine(self::get_user_fields(), self::get_user_fields());
    }

    /**
     * Ensures that no HTML is saved to externalfield field
     * but preserves all special characters that can be a part of the claim
     * @return boolean true if validation is successful, string error if externalfield is not validated
     */
    protected function validate_externalfield($value){
        // This parameter type is set to PARAM_RAW_TRIMMED and HTML check is done here.
        if (clean_param($value, PARAM_NOTAGS) !== $value){
            return new lang_string('userfieldexternalfield_error', 'tool_oauth2');
        }
        return true;
    }
}
