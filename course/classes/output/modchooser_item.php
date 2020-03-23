<?php
//

/**
 * The modchooser_item renderable.
 *
 * @package    core_course
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_course\output;
defined('MOODLE_INTERNAL') || die();

use context;
use lang_string;
use pix_icon;

/**
 * The modchooser_item renderable class.
 *
 * @package    core_course
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class modchooser_item extends \core\output\chooser_item {

    /** @var string */
    protected $customiconurl;

    /**
     * Constructor.
     *
     * @param stdClass $module The module.
     * @param context $context The relevant context.
     */
    public function __construct($module, context $context) {
        // The property 'name' may contain more than just the module, in which case we need to extract the true module name.
        $modulename = $module->name;
        if ($colon = strpos($modulename, ':')) {
            $modulename = substr($modulename, 0, $colon);
        }
        if (preg_match('/src="([^"]*)"/i', $module->icon, $matches)) {
            // Use the custom icon.
            $this->customiconurl = str_replace('&amp;', '&', $matches[1]);
        }

        $icon = new pix_icon('icon', '', $modulename, ['class' => 'icon']);
        $help = isset($module->help) ? $module->help : new lang_string('nohelpforactivityorresource', 'moodle');

        parent::__construct($module->name, $module->title, $module->link->out(false), $icon, $help, $context);
    }

    /**
     * Export for template.
     *
     * @param \renderer_base $output The renderer
     * @return \stdClass $data
     */
    public function export_for_template(\renderer_base $output) {
        $data = parent::export_for_template($output);
        if ($this->customiconurl && !empty($data->icon['attributes'])) {
            // Replace icon source with a module-provided icon.
            foreach ($data->icon['attributes'] as &$attribute) {
                if ($attribute['name'] === 'src') {
                    $attribute['value'] = $this->customiconurl;
                }
            }
        }
        return $data;
    }
}
