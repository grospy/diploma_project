<?php
//

/**
 * Mobile cache definitions.
 *
 * @package    tool_mobile
 * @copyright  2017 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$definitions = array(
    'plugininfo' => array(
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => true,
        'staticacceleration' => true,
        'staticaccelerationsize' => 1
    )
);
