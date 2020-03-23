<?php
//

/**
 * User evidence persistent.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_competency;
defined('MOODLE_INTERNAL') || die();

use context_user;
use lang_string;

/**
 * User evidence persistent class.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_evidence extends persistent {

    const TABLE = 'competency_userevidence';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() {
        return array(
            'userid' => array(
                'type' => PARAM_INT
            ),
            'name' => array(
                'type' => PARAM_TEXT
            ),
            'description' => array(
                'type' => PARAM_CLEANHTML,
                'default' => '',
            ),
            'descriptionformat' => array(
                'choices' => array(FORMAT_HTML, FORMAT_MOODLE, FORMAT_PLAIN, FORMAT_MARKDOWN),
                'type' => PARAM_INT,
                'default' => FORMAT_HTML,
            ),
            'url' => array(
                'type' => PARAM_URL,
                'default' => '',
                'message' => new lang_string('invalidurl', 'core_competency')
            )
        );
    }

    /**
     * Can the current user manage this user evidence?
     *
     * @return bool
     */
    public function can_manage() {
        return self::can_manage_user($this->get('userid'));
    }

    /**
     * Can the current user view this user evidence?
     *
     * @return bool
     */
    public function can_read() {
        return self::can_read_user($this->get('userid'));
    }

    /**
     * Get the context of this user evidence.
     *
     * @return context
     */
    public function get_context() {
        return context_user::instance($this->get('userid'));
    }

    /**
     * Get link competencies.
     */
    public function get_competencies() {
        return user_evidence_competency::get_competencies_by_userevidenceid($this->get('id'));
    }

    /**
     * Get link user competencies.
     */
    public function get_user_competencies() {
        return user_evidence_competency::get_user_competencies_by_userevidenceid($this->get('id'));
    }

    /**
     * Return true if the user of the evidence has plan.
     *
     * @return bool
     */
    public function user_has_plan() {
        return plan::record_exists_select('userid = ?', array($this->get('userid')));
    }

    /**
     * Return the files associated with this evidence.
     *
     * @return object[]
     */
    public function get_files() {
        $fs = get_file_storage();
        $files = $fs->get_area_files($this->get_context()->id, 'core_competency', 'userevidence', $this->get('id'),
            'filename', false);
        return $files;
    }

    /**
     * Validate the URL.
     *
     * @param  int $value
     * @return true|lang_string
     */
    protected function validate_url($value) {
        if (empty($value) && !is_numeric($value)) {
            return true;
        }
        if (!preg_match('@^https?://.+@', $value)) {
            return new lang_string('invalidurl', 'core_competency');
        }
        return true;
    }

    /**
     * Validate the user ID.
     *
     * @param  int $value
     * @return true|lang_string
     */
    protected function validate_userid($value) {
        global $DB;

        // During create.
        if (!$this->get('id')) {

            // Check that the user exists. We do not need to do that on update because
            // the userid of an evidence should never change.
            if (!$DB->record_exists('user', array('id' => $value))) {
                return new lang_string('invaliddata', 'error');
            }

        }

        return true;
    }

    /**
     * Can the current user manage a user's evidence?
     *
     * @param  int $evidenceuserid The user to whom the evidence would belong.
     * @return bool
     */
    public static function can_manage_user($evidenceuserid) {
        global $USER;
        $context = context_user::instance($evidenceuserid);

        $capabilities = array('moodle/competency:userevidencemanage');
        if ($context->instanceid == $USER->id) {
            $capabilities[] = 'moodle/competency:userevidencemanageown';
        }

        return has_any_capability($capabilities, $context);
    }

    /**
     * Can the current user view a user's evidence?
     *
     * @param  int $evidenceuserid The user to whom the evidence would belong.
     * @return bool
     */
    public static function can_read_user($evidenceuserid) {
        $context = context_user::instance($evidenceuserid);

        $capabilities = array('moodle/competency:userevidenceview');

        return has_any_capability($capabilities, $context) || self::can_manage_user($evidenceuserid);
    }

}
