<?php
//
/**
 * Event for when a new blog entry is associated with a context.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for event to be triggered when an external blog is added to moodle.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string url: web address of the external blog added.
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class blog_external_added extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'blog_external';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventblogexternaladded', 'core_blog');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' added the external blog with the id '{$this->objectid}'" .
            " from the web address '{$this->other['url']}'.";
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception when validation fails.
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['url'])) {
            throw new \coding_exception('The \'url\' value must be set in other.');
        }
    }

    /**
     * Used for maping events on restore
     *
     * @return bool
     */
    public static function get_other_mapping() {
        // No mapping required.
        return false;
    }

    /**
     * Used for restore of events.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        // Blogs are not backed up, so no mapping required for restore.
        return array('db' => 'blog_external', 'restore' => base::NOT_MAPPED);
    }

}
