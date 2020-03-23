<?php
//

/**
 * Silly behat_form_select extension.
 *
 * @package    core_form
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__  . '/behat_form_text.php');

/**
 * Allows interaction with passwordunmask form fields.
 *
 * Plain behat_form_select extension as it is the same
 * kind of field.
 *
 * @package    core_form
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_form_passwordunmask extends behat_form_text {
    /**
     * Sets the value to a field.
     *
     * @param string $value
     * @return void
     */
    public function set_value($value) {
        if ($this->running_javascript()) {
            $id = $this->field->getAttribute('id');
            $js = <<<JS
require(["jquery"], function($) {
    var wrapper = $(document.getElementById("{$id}")).closest('[data-passwordunmask="wrapper"]');
        wrapper.find('[data-passwordunmask="edit"]').trigger("click");
});
JS;
            $this->session->executeScript($js);
        }

        $this->field->setValue($value);

        // Ensure all pending JS is finished.
        if ($this->running_javascript()) {
            // Press enter key after setting password, so we have a stable page.
            $this->field->keyDown(13);
            $this->field->keyPress(13);
            $this->field->keyUp(13);
            $this->session->wait(behat_base::get_timeout() * 1000, behat_base::PAGE_READY_JS);
        }
    }
}
