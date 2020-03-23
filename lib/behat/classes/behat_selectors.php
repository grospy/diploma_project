<?php
//

/**
 * Moodle-specific selectors.
 *
 * @package    core
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/named_selector.php');
require_once(__DIR__ . '/exact_named_selector.php');
require_once(__DIR__ . '/partial_named_selector.php');

use Behat\Mink\Exception\ExpectationException as ExpectationException;
use Behat\Mink\Element\Element;

/**
 * Moodle selectors manager.
 *
 * @package    core
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_selectors {

    /**
     * Returns the behat selector and locator for a given moodle selector and locator
     *
     * @param string $selectortype The moodle selector type, which includes moodle selectors
     * @param string $element The locator we look for in that kind of selector
     * @param Session $session The Mink opened session
     * @return array Contains the selector and the locator expected by Mink.
     */
    public static function get_behat_selector($selectortype, $element, Behat\Mink\Session $session) {
        // Note: This function is not deprecated, but not the recommended way of doing things.
        [
            'selector' => $selector,
            'locator' => $locator,
        ] = $session->normalise_selector($selectortype, $element, $session->getPage());

        // CSS and XPath selectors locator is one single argument.
        return [$selector, $locator];
    }

    /**
     * Allowed selectors getter.
     *
     * @return array
     */
    public static function get_allowed_selectors() {
        return array_merge(
            behat_partial_named_selector::get_allowed_selectors(),
            behat_exact_named_selector::get_allowed_selectors()
        );
    }

    /**
     * Allowed text selectors getter.
     *
     * @return array
     */
    public static function get_allowed_text_selectors() {
        return array_merge(
            behat_partial_named_selector::get_allowed_text_selectors(),
            behat_exact_named_selector::get_allowed_text_selectors()
        );
    }

    /**
     * Normalise the selector and locator for a named partial.
     *
     * @param string $selector The selector name
     * @param string $locator The value to normalise
     * @return array
     */
    public static function normalise_named_selector(string $selector, string $locator): array {
        return [
            $selector,
            behat_context_helper::escape($locator),
        ];
    }

    /**
     * Transform the selector for a field.
     *
     * @param string $label The label to find
     * @param Element $container The container to look within
     * @return array The selector, locator, and container to search within
     */
    public static function transform_find_for_field(behat_base $context, string $label, Element $container): array {
        $hasfieldset = strpos($label, '>');
        if (false !== $hasfieldset) {
            [$containerlabel, $label] = explode(">", $label, 2);
            $container = $context->find_fieldset(trim($containerlabel), $container);
            $label = trim($label);
        }

        return [
            'selector' => 'named_partial',
            'locator' => self::normalise_named_selector('field', $label),
            'container' => $container,
        ];
    }
}
