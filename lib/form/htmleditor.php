<?php
//


/**
 * htmleditor type form element
 *
 * Contains HTML class for htmleditor type element
 *
 * @deprecated since 3.6
 * @package   core_form
 * @copyright 2006 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

global $CFG;
require_once("$CFG->libdir/form/textarea.php");

/**
 * htmleditor type form element
 *
 * HTML class for htmleditor type element
 *
 * @package   core_form
 * @category  form
 * @copyright 2006 Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleQuickForm_htmleditor extends MoodleQuickForm_textarea{
    /** @var string defines the type of editor */
    var $_type;

    /** @var array default options for html editor, which can be overridden */
    var $_options=array('rows'=>10, 'cols'=>45, 'width'=>0,'height'=>0);

    /**
     * Constructor
     *
     * @param string $elementName (optional) name of the html editor
     * @param string $elementLabel (optional) editor label
     * @param array $options set of options to create html editor
     * @param array $attributes (optional) Either a typical HTML attribute string
     *              or an associative array
     */
    public function __construct($elementName=null, $elementLabel=null, $options=array(), $attributes=null){
        debugging("The form element 'htmleditor' has been deprecated. Please use the 'editor' element instead.", DEBUG_DEVELOPER);

        parent::__construct($elementName, $elementLabel, $attributes);
        // set the options, do not bother setting bogus ones
        if (is_array($options)) {
            foreach ($options as $name => $value) {
                if (array_key_exists($name, $this->_options)) {
                    if (is_array($value) && is_array($this->_options[$name])) {
                        $this->_options[$name] = @array_merge($this->_options[$name], $value);
                    } else {
                        $this->_options[$name] = $value;
                    }
                }
            }
        }
        $this->_type='htmleditor';

        editors_head_setup();
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function MoodleQuickForm_htmleditor($elementName=null, $elementLabel=null, $options=array(), $attributes=null) {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        self::__construct($elementName, $elementLabel, $options, $attributes);
    }

    /**
     * Returns the input field in HTML
     *
     * @return string
     */
    public function toHtml() {
        global $OUTPUT;

        if ($this->_flagFrozen) {
            return $this->getFrozenHtml();
        } else {
            $value = preg_replace("/(\r\n|\n|\r)/", '&#010;', $this->getValue());

            return $this->_getTabs() .
                $OUTPUT->print_textarea($this->getName(), $this->getAttribute('id'), $value, $this->_options['rows'],
                    $this->_options['cols']);
        }
    }

    /**
     * What to display when element is frozen.
     *
     * @return string
     */
    function getFrozenHtml()
    {
        $html = format_text($this->getValue());
        return $html . $this->_getPersistantData();
    }
}
