<?php
//

/**
 * customlang specific renderers.
 *
 * @package   tool_customlang
 * @copyright 2019 Moodle
 * @author    Bas Brands
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_customlang\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use stdClass;

/**
 * Class containing data for customlang translator page
 *
 * @copyright  2019 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class translator implements renderable, templatable {

    /**
     * @var tool_customlang_translator $translator object.
     */
    private $translator;

    /**
     * Construct this renderable.
     *
     * @param tool_customlang_translator $translator The translator object.
     */
    public function __construct(\tool_customlang_translator $translator) {
        $this->translator = $translator;
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();

        $data->nostrings = $output->notification(get_string('nostringsfound', 'tool_customlang'));
        $data->formurl = $this->translator->handler;
        $data->currentpage = $this->translator->currentpage;
        $data->sesskey = sesskey();
        $data->strings = [];

        if (!empty($this->translator->strings)) {
            $data->hasstrings = true;
            foreach ($this->translator->strings as $string) {
                // Find strings that use placeholders.
                if (preg_match('/\{\$a(->.+)?\}/', $string->master)) {
                    $string->placeholderhelp = $output->help_icon('placeholder', 'tool_customlang',
                            get_string('placeholderwarning', 'tool_customlang'));
                }
                if (!is_null($string->local) and $string->outdated) {
                    $string->outdatedhelp = $output->help_icon('markinguptodate', 'tool_customlang');
                    $string->checkupdated = true;
                }
                if ($string->original !== $string->master) {
                    $string->showoriginalvsmaster = true;
                }
                $string->local = s($string->local);
                $data->strings[] = $string;
            }
        }
        return $data;
    }
}