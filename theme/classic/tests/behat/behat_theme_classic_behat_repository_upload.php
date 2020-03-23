<?php
//

/**
 * Override definitions for the upload repository type for the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../repository/upload/tests/behat/behat_repository_upload.php');

use Behat\Mink\Exception\ExpectationException as ExpectationException;

/**
 * Override step definitions to deal with the upload repository in the Classic theme.
 *
 * @package    theme_classic
 * @category   test
 * @copyright  2019 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_theme_classic_behat_repository_upload extends behat_repository_upload {

    /**
     * Gets the NodeElement for filepicker of filemanager moodleform element.
     *
     * @throws ExpectationException
     * @param  string $filepickerelement The filepicker form field label
     * @return NodeElement The hidden element node.
     */
    protected function get_filepicker_node($filepickerelement) {

        // More info about the problem (in case there is a problem).
        $exception = new ExpectationException('"' . $filepickerelement . '" filepicker can not be found', $this->getSession());

        // If no file picker label is mentioned take the first file picker from the page.
        if (empty($filepickerelement)) {
            $filepickercontainer = $this->find(
                'xpath',
                "//*[@class=\"form-filemanager\"]",
                $exception
            );
        } else {
            // Gets the ffilemanager node specified by the locator which contains the filepicker container.
            $filepickerelement = behat_context_helper::escape($filepickerelement);
            $filepickercontainer = $this->find(
                'xpath',
                "//input[./@id = //label[normalize-space(.)=$filepickerelement]/@for]" .
                    "//ancestor::div[contains(concat(' ', normalize-space(@class), ' '), ' felement ')]",
                $exception
            );
        }

        return $filepickercontainer;
    }
}
