<?php
//

/**
 * Contains endorsement class for displaying a badge endorsement.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for displaying a badge endorsement.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class endorsement_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'id' => [
                'type' => PARAM_INT,
                'description' => 'Endorsement id',
            ],
            'badgeid' => [
                'type' => PARAM_INT,
                'description' => 'Badge id',
            ],
            'issuername' => [
                'type' => PARAM_TEXT,
                'description' => 'Endorsement issuer name',
            ],
            'issuerurl' => [
                'type' => PARAM_URL,
                'description' => 'Endorsement issuer URL',
            ],
            'issueremail' => [
                'type' => PARAM_RAW,
                'description' => 'Endorsement issuer email',
            ],
            'claimid' => [
                'type' => PARAM_URL,
                'description' => 'Claim URL',
                'null' => NULL_ALLOWED,
            ],
            'claimcomment' => [
                'type' => PARAM_NOTAGS,
                'description' => 'Claim comment',
                'null' => NULL_ALLOWED,
            ],
            'dateissued' => [
                'type' => PARAM_INT,
                'description' => 'Date issued',
                'default' => 0,
            ]
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
