<?php
//

/**
 * Base class for question category events.
 *
 * @package    core
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Base class for question category events
 *
 * @package    core
 * @since      Moodle 3.7
 * @copyright  2019 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class question_category_base extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'question_categories';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        if ($this->courseid) {
            $cat = $this->objectid . ',' . $this->contextid;
            if ($this->contextlevel == CONTEXT_MODULE) {
                return new \moodle_url('/question/edit.php', ['cmid' => $this->contextinstanceid, 'cat' => $cat]);
            }
            return new \moodle_url('/question/edit.php', ['courseid' => $this->courseid, 'cat' => $cat]);
        }
        // Lets try viewing from the frontpage for contexts above course.
        return new \moodle_url('/question/category.php', ['courseid' => SITEID, 'edit' => $this->objectid]);
    }

    /**
     * Returns DB mappings used with backup / restore.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return ['db' => 'question_categories', 'restore' => 'question_categories'];
    }

    /**
     * Create a event from question category object
     *
     * @param object $category
     * @param object|null $context
     * @return base
     * @throws \coding_exception
     */
    public static function create_from_question_category_instance($category, $context = null) {

        $params = ['objectid' => $category->id];

        if (!empty($category->contextid)) {
            $params['contextid'] = $category->contextid;
        }

        $params['context'] = $context;

        $event = self::create($params);
        return $event;
    }
}

