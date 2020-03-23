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
 * Class for event to be triggered when a new blog entry is deleted with a context.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int blogid: id of blog.
 * }
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class blog_association_deleted extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->context = \context_system::instance();
        $this->data['objecttable'] = 'blog_association';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventblogassociationdeleted', 'core_blog');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' removed the associations from the blog entry with id "
            . "'{$this->other['blogid']}'.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/blog/index.php', array('entryid' => $this->other['blogid']));
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception when validation fails.
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }

        if (!isset($this->other['blogid'])) {
            throw new \coding_exception('The \'blogid\' value must be set in other.');
        }
    }

    /**
     * Used for restore of objectid.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        // Blogs are not included in backups, so no mapping required for restore.
        return array('db' => 'blog_association', 'restore' => base::NOT_MAPPED);
    }

    /**
     * Used for mappings of "other" data on restore.
     *
     * @return array
     */
    public static function get_other_mapping() {
        // Blogs are not included in backups, so no mapping required for restore.
        $othermapped = array();
        $othermapped['blogid'] = array('db' => 'post', 'restore' => base::NOT_MAPPED);

        return $othermapped;
    }
}
