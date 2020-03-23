<?php
//


/**
 * Header form element
 *
 * Contains a pseudo-element used for adding headers to form
 *
 * @package   core_form
 * @copyright 2007 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once 'HTML/QuickForm/header.php';

/**
 * Header form element
 *
 * A pseudo-element used for adding headers to form
 *
 * @package   core_form
 * @category  form
 * @copyright 2007 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleQuickForm_header extends HTML_QuickForm_header
{
    /** @var string html for help button, if empty then no help */
    var $_helpbutton='';

    /**
     * constructor
     *
     * @param string $elementName name of the header element
     * @param string $text text displayed in header element
     */
    public function __construct($elementName = null, $text = null) {
        parent::__construct($elementName, $text);
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function MoodleQuickForm_header($elementName = null, $text = null) {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        self::__construct($elementName, $text);
    }

   /**
    * Accepts a renderer
    *
    * @param HTML_QuickForm_Renderer $renderer a HTML_QuickForm_Renderer object
    */
    function accept(&$renderer, $required=false, $error=null)
    {
        $this->_text .= $this->getHelpButton();
        $renderer->renderHeader($this);
    }

    /**
     * get html for help button
     *
     * @return string html for help button
     */
    function getHelpButton(){
        return $this->_helpbutton;
    }
}