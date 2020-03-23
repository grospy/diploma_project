<?php
//

/**
 * This file contains the forms used by the restore stages
 *
 * @package   core_backup
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * An abstract moodleform class specially designed for the restore forms.
 *
 * @abstract Marked abstract here because some idiot forgot to mark it abstract in code!
 * @package   core_backup
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_moodleform extends base_moodleform {
    /**
     * Constructor.
     *
     * Overridden just for the purpose of typehinting the first arg.
     *
     * @param restore_ui_stage $uistage
     * @param null $action
     * @param null $customdata
     * @param string $method
     * @param string $target
     * @param null $attributes
     * @param bool $editable
     */
    public function __construct(restore_ui_stage $uistage, $action = null, $customdata = null, $method = 'post',
                                $target = '', $attributes = null, $editable = true) {
        parent::__construct($uistage, $action, $customdata, $method, $target, $attributes, $editable);
    }
}

/**
 * Restore settings form.
 *
 * @package   core_backup
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_settings_form extends restore_moodleform {}

/**
 * Restore schema review form.
 *
 * @package   core_backup
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_schema_form extends restore_moodleform {}

/**
 * Restore complete process review form.
 *
 * @package   core_backup
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_review_form extends restore_moodleform {};