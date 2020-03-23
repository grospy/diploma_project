<?php
//


/**
 * Hidden type form element
 *
 * Contains HTML class for a hidden type element
 *
 * @package   core_form
 * @copyright 2006 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('HTML/QuickForm/hidden.php');

/**
 * Hidden type form element
 *
 * HTML class for a hidden type element
 *
 * @package   core_form
 * @category  form
 * @copyright 2006 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleQuickForm_hidden extends HTML_QuickForm_hidden{
    /** @var string html for help button, if empty then no help */
    var $_helpbutton='';

    /**
     * Constructor
     *
     * @param string $elementName (optional) name of the hidden element
     * @param string $value (optional) value of the element
     * @param mixed  $attributes (optional) Either a typical HTML attribute string
     *               or an associative array
     */
    public function __construct($elementName=null, $value='', $attributes=null) {
        parent::__construct($elementName, $value, $attributes);
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function MoodleQuickForm_hidden($elementName=null, $value='', $attributes=null) {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        return self::__construct($elementName, $value, $attributes);
    }

    /**
     * @deprecated since Moodle 2.0
     */
    function setHelpButton($helpbuttonargs, $function='helpbutton'){
        throw new coding_exception('setHelpButton() can not be used any more, please see MoodleQuickForm::addHelpButton().');
    }

    /**
     * get html for help button
     *
     * @return string html for help button
     */
    function getHelpButton(){
        return '';
    }
}
