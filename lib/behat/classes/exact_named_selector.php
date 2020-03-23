<?php
//

/**
 * Moodle-specific named exact selectors.
 *
 * @package    core
 * @category   test
 * @copyright  2016 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Moodle selectors manager.
 *
 * @package    core
 * @copyright  2016 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_exact_named_selector extends \Behat\Mink\Selector\ExactNamedSelector {

    // Use the named selector trait.
    use behat_named_selector;

    /**
     * Creates selector instance.
     */
    public function __construct() {
        $this->registerReplacement('%iconMatch%', "(contains(concat(' ', @class, ' '), ' icon ') or name() = 'img')");
        $this->registerReplacement('%imgAltMatch%', './/*[%iconMatch% and (%altMatch% or %titleMatch%)]');
        parent::__construct();
    }

    /**
     * @var Allowed types when using text selectors arguments.
     */
    protected static $allowedtextselectors = [];

    /**
     * @var Allowed types when using selector arguments.
     */
    protected static $allowedselectors = array(
        'button_exact' => 'button',
        'checkbox_exact' => 'checkbox',
        'field_exact' => 'field',
        'fieldset_exact' => 'fieldset',
        'link_exact' => 'link',
        'link_or_button_exact' => 'link_or_button',
        'option_exact' => 'option',
        'radio_exact' => 'radio',
        'select_exact' => 'select',
        'table_exact' => 'table',
        'text_exact' => 'text',
    );

    /** @var List of deprecated selectors */
    protected static $deprecatedselectors = [];

    /**
     * Allowed selectors getter.
     *
     * @return array
     */
    public static function get_allowed_selectors() {
        return static::$allowedselectors;
    }

    /**
     * Allowed text selectors getter.
     *
     * @return array
     */
    public static function get_allowed_text_selectors() {
        return static::$allowedtextselectors;
    }
}
