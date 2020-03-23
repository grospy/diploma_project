<?php
//

/**
 * Question behaviour for the old adaptive mode, with no penalties.
 *
 * @package    qbehaviour
 * @subpackage adaptivenopenalty
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../adaptive/behaviour.php');


/**
 * Question behaviour for adaptive mode, with no penalties.
 *
 * This is the old version of interactive mode, without penalties.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_adaptivenopenalty extends qbehaviour_adaptive {
    protected function adjusted_fraction($fraction, $prevtries) {
        return $fraction;
    }
}
