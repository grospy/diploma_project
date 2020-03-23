<?php
//


/**
 * static warning element
 *
 * Contains class for static warning type element
 *
 * @package   core_form
 * @copyright 2008 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once("HTML/QuickForm/static.php");
require_once('templatable_form_element.php');

/**
 * static warning
 *
 * overrides {@link HTML_QuickForm_static} to display staic warning.
 *
 * @package   core_form
 * @category  form
 * @copyright 2008 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleQuickForm_warning extends HTML_QuickForm_static implements templatable {
    use templatable_form_element {
        export_for_template as export_for_template_base;
    }

    /** @var string Form element type */
    var $_elementTemplateType='warning';

    /** @var string html for help button, if empty then no help */
    var $_helpbutton='';

    /** @var string class assigned to field, default is notifyproblem */
    var $_class='';

    /**
     * constructor
     *
     * @param string $elementName (optional) name of the field
     * @param string $elementClass (optional) show as warning or notification => 'notifyproblem'
     * @param string $text (optional) Text to put in warning field
     */
    public function __construct($elementName=null, $elementClass='notifyproblem', $text=null) {
        parent::__construct($elementName, null, $text);
        $this->_type = 'warning';
        if (is_null($elementClass)) {
            $elementClass = 'notifyproblem';
        }
        $this->_class = $elementClass;
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function MoodleQuickForm_warning($elementName=null, $elementClass='notifyproblem', $text=null) {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        self::__construct($elementName, $elementClass, $text);
    }

    /**
     * Returns HTML for this form element.
     *
     * @return string
     */
    function toHtml() {
        global $OUTPUT;
        return $OUTPUT->notification($this->_text, $this->_class);
    }

    /**
     * get html for help button
     *
     * @return string html for help button
     */
    function getHelpButton(){
        return $this->_helpbutton;
    }

    /**
     * Gets the type of form element
     *
     * @return string
     */
    function getElementTemplateType(){
        return $this->_elementTemplateType;
    }

    public function export_for_template(renderer_base $output) {
        $context = $this->export_for_template_base($output);
        $context['html'] = $this->toHtml();
        return $context;
    }
}
