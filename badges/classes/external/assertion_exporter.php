<?php
//

/**
 * Contains class for displaying a assertion.
 *
 * @package   core_badges
 * @copyright 2019 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;
use renderer_base;
use stdClass;

/**
 * Class for displaying a badge competency.
 *
 * @package   core_badges
 * @copyright 2019 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assertion_exporter extends exporter {

    /**
     * Map from a request response data to the internal structure.
     *
     * @param stdClass $data The remote data.
     * @param string $apiversion The backpack version used to communicate remotely.
     * @return stdClass
     */
    public static function map_external_data($data, $apiversion) {
        $mapped = new \stdClass();
        if (isset($data->entityType)) {
            $mapped->type = $data->entityType;
        } else {
            $mapped->type = $data->type;
        }
        if (isset($data->entityId)) {
            $mapped->id = $data->entityId;
        } else {
            $mapped->id = $data->id;
        }
        if (isset($data->issuedOn)) {
            $mapped->issuedOn = $data->issuedOn;
        }
        if (isset($data->recipient)) {
            $mapped->recipient = $data->recipient;
        }
        if (isset($data->badgeclass)) {
            $mapped->badgeclass = $data->badgeclass;
        }
        $propname = '@context';
        $mapped->$propname = 'https://w3id.org/openbadges/v2';
        return $mapped;
    }

    /**
     * Return the list of additional properties.
     *
     * @return array
     */
    protected static function define_other_properties() {
        return array(
            'badge' => array(
                'type' => badgeclass_exporter::read_properties_definition(),
                'optional' => true
            ),
            'recipient' => array(
                'type' => recipient_exporter::read_properties_definition(),
                'optional' => true
            ),
            'verification' => array(
                'type' => verification_exporter::read_properties_definition(),
                'optional' => true
            )
        );
    }

    /**
     * We map from related data passed as data to this exporter to clean exportable values.
     *
     * @param renderer_base $output
     * @return array
     */
    protected function get_other_values(renderer_base $output) {
        global $DB;
        $result = [];

        if (array_key_exists('related_badge', $this->data)) {
            $exporter = new badgeclass_exporter($this->data['related_badge'], $this->related);
            $result['badge'] = $exporter->export($output);
        }
        if (array_key_exists('related_recipient', $this->data)) {
            $exporter = new recipient_exporter($this->data['related_recipient'], $this->related);
            $result['recipient'] = $exporter->export($output);
        }
        if (array_key_exists('related_verify', $this->data)) {
            $exporter = new verification_exporter($this->data['related_verify'], $this->related);
            $result['verification'] = $exporter->export($output);
        }
        return $result;
    }

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'type' => [
                'type' => PARAM_ALPHA,
                'description' => 'Issuer',
            ],
            'id' => [
                'type' => PARAM_URL,
                'description' => 'Unique identifier for this assertion',
            ],
            'badgeclass' => [
                'type' => PARAM_RAW,
                'description' => 'Identifier of the badge for this assertion',
                'optional' => true,
            ],
            'issuedOn' => [
                'type' => PARAM_RAW,
                'description' => 'Date this badge was issued',
            ],
            'expires' => [
                'type' => PARAM_RAW,
                'description' => 'Date this badge will expire',
                'optional' => true,
            ],
            '@context' => [
                'type' => PARAM_URL,
                'description' => 'Badge version',
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
            'context' => 'context'
        );
    }
}
