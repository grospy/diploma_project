<?php
//

/**
 * Moodle implementation of RTLCSS.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Moodle RTLCSS class.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_rtlcss extends \MoodleHQ\RTLCSS\RTLCSS {

    /**
     * Process a block declaration.
     *
     * This is overriden in order to provide a backwards compability with the plugins
     * who already defined RTL styles the old-fashioned way. Because we do not need
     * those any more we rename them so that they do not apply.
     *
     * @todo Remove the dir-rtl flipping when dir-rtl is fully deprecated.
     * @param \Sabberworm\CSS\RuleSet\RuleSet $node The object.
     * @return void
     */
    protected function processDeclaration($node) {
        $selectors = $node instanceof \Sabberworm\CSS\RuleSet\DeclarationBlock ? $node->getSelectors() : [];
        foreach ($selectors as $selector) {
            // The blocks containing .dir-rtl are always accepted as is.
            if (strpos($selector->getSelector(), '.dir-rtl') !== false) {
                return;
            }
        }
        return parent::processDeclaration($node);
    }

}
