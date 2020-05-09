<?php
//

/**
 * Steps definitions related with the glossary activity.
 *
 * @package    mod_glossary
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

use Behat\Gherkin\Node\TableNode as TableNode;

/**
 * Glossary-related steps definitions.
 *
 * @package    mod_glossary
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_mod_glossary extends behat_base {

    /**
     * Adds an entry to the current glossary with the provided data. You should be in the glossary page.
     *
     * @Given /^I add a glossary entry with the following data:$/
     * @param TableNode $data
     */
    public function i_add_a_glossary_entry_with_the_following_data(TableNode $data) {
        $this->execute("behat_forms::press_button", get_string('addentry', 'mod_glossary'));

        $this->execute("behat_forms::i_set_the_following_fields_to_these_values", $data);

        $this->execute("behat_forms::press_button", get_string('savechanges'));
    }

    /**
     * Adds a category with the specified name to the current glossary. You need to be in the glossary page.
     *
     * @Given /^I add a glossary entries category named "(?P<category_name_string>(?:[^"]|\\")*)"$/
     * @param string $categoryname Category name
     */
    public function i_add_a_glossary_entries_category_named($categoryname) {

        $this->execute("behat_general::click_link", get_string('categoryview', 'mod_glossary'));

        $this->execute("behat_forms::press_button", get_string('editcategories', 'mod_glossary'));

        $this->execute("behat_forms::press_button", get_string('addcategory', 'glossary'));

        $this->execute('behat_forms::i_set_the_field_to', array('name', $this->escape($categoryname)));

        $this->execute("behat_forms::press_button", get_string('savechanges'));
        $this->execute("behat_forms::press_button", get_string('back', 'mod_glossary'));
    }
}