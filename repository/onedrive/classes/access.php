<?php
//

/**
 * Class for loading/storing access records from the DB.
 *
 * @package    repository_onedrive
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace repository_onedrive;

defined('MOODLE_INTERNAL') || die();

use core\persistent;

/**
 * Class for loading/storing issuer from the DB
 *
 * @package    repository_onedrive
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class access extends persistent {

    const TABLE = 'repository_onedrive_access';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'permissionid' => array(
                'type' => PARAM_RAW
            ),
            'itemid' => array(
                'type' => PARAM_RAW
            )
        );
    }

}
