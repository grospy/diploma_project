<?php
//

/**
 * An object that contains sql join fragments.
 *
 * @since      Moodle 3.1
 * @package    core
 * @category   dml
 * @copyright  2016 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\dml;

defined('MOODLE_INTERNAL') || die();

/**
 * An object that contains sql join fragments.
 *
 * @since      Moodle 3.1
 * @package    core
 * @category   dml
 * @copyright  2016 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sql_join {

    /**
     * @var string joins.
     */
    public $joins;

    /**
     * @var string wheres.
     */
    public $wheres;

    /**
     * @var array params.
     */
    public $params;

    /**
     * Create an object that contains sql join fragments.
     *
     * @param string $joins The join sql fragment.
     * @param string $wheres The where sql fragment.
     * @param array $params Any parameter values.
     */
    public function __construct($joins = '', $wheres = '', $params = array()) {
        $this->joins = $joins;
        $this->wheres = $wheres;
        $this->params = $params;
    }
}
