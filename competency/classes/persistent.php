<?php
//

/**
 * Abstract class for core_competency objects saved to the DB.
 *
 * @package    core_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency;
defined('MOODLE_INTERNAL') || die();

// We need to alias the invalid_persistent_exception, because the persistent classes from
// core_competency used to throw a \core_competency\invalid_persistent_exception. They now
// fully inherit from \core\persistent which throws a core exception. Using class_alias
// ensures that previous try/catch statements still work. Also note that we always need
// need to alias, we cannot do it passively in the classloader because try/catch statements
// do not trigger a class loading. Note that for this trick to work, all the classes
// which were extending \core_competency\persistent still need to extend it or the alias
// won't be effective.
class_alias('core\\invalid_persistent_exception', 'core_competency\\invalid_persistent_exception');

/**
 * Abstract class for core_competency objects saved to the DB.
 *
 * This is a legacy class which all core_competency persistent classes created prior
 * to 3.3 must extend.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class persistent extends \core\persistent {
    /**
     * Magic method to capture getters and setters.
     * This is only available for competency persistents for backwards compatibility.
     * It is recommended to use get('propertyname') and set('propertyname', 'value') directly.
     *
     * @param  string $method Callee.
     * @param  array $arguments List of arguments.
     * @return mixed
     */
    final public function __call($method, $arguments) {
        debugging('Use of magic setters and getters is deprecated. Use get() and set().', DEBUG_DEVELOPER);
        if (strpos($method, 'get_') === 0) {
            return $this->get(substr($method, 4));
        } else if (strpos($method, 'set_') === 0) {
            return $this->set(substr($method, 4), $arguments[0]);
        }
        throw new \coding_exception('Unexpected method call: ' . $method);
    }

}
