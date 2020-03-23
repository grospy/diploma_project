<?php
//

/**
 * Approved result set for unit testing.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_privacy\tests\request;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Fetch Result Set.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class approved_contextlist extends \core_privacy\local\request\approved_contextlist {
    /**
     * Add a single context to this approved_contextlist.
     *
     * @param   \context    $context        The context to be added.
     * @return  $this
     */
    public function add_context(\context $context) {
        return $this->add_context_by_id($context->id);
    }

    /**
     * Add a single context to this approved_contextlist by it's ID.
     *
     * @param   int         $contextid      The context to be added.
     * @return  $this
     */
    public function add_context_by_id($contextid) {
        return $this->set_contextids(array_merge($this->get_contextids(), [$contextid]));
    }

    /**
     * Add a set of contexts to this approved_contextlist.
     *
     * @param   \context[]  $contexts       The contexts to be added.
     * @return  $this
     */
    public function add_contexts(array $contexts) {
        foreach ($contexts as $context) {
            $this->add_context($context);
        }
    }

    /**
     * Add a set of contexts to this approved_contextlist by ID.
     *
     * @param   int[]       $contexts       The contexts to be added.
     * @return  $this
     */
    public function add_contexts_by_id(array $contexts) {
        foreach ($contexts as $contextid) {
            $this->add_context_by_id($contextid);
        }
    }
}
