<?php
//

/**
 * Contains class for displaying a recipient.
 *
 * @package   core_badges
 * @copyright 2019 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for displaying a badge competency.
 *
 * @package   core_badges
 * @copyright 2019 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class recipient_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'identity' => [
                'type' => PARAM_RAW,
                'description' => 'Hashed email address to issue badge to.',
            ],
            'plaintextIdentity' => [
                'type' => PARAM_RAW,
                'description' => 'Email address to issue badge to.',
                'optional' => true,
            ],
            'salt' => [
                'type' => PARAM_RAW,
                'description' => 'Salt used to hash email.',
                'optional' => true,
            ],
            'type' => [
                'type' => PARAM_ALPHA,
                'description' => 'Email',
            ],
            'hashed' => [
                'type' => PARAM_BOOL,
                'description' => 'Should be true',
            ],
        ];
    }

    /**
     * Returns a list of objects that are related.
     *
     * @return array
     */
    protected static function define_related() {
        return array(
            'context' => 'context',
        );
    }
}
