<?php
//

/**
 * The qbank_chooser_item renderable.
 *
 * @package    core_question
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_question\output;
defined('MOODLE_INTERNAL') || die();

use lang_string;
use pix_icon;


/**
 * The qbank_chooser_item renderable class.
 *
 * @package    core_question
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbank_chooser_item extends \core\output\chooser_item {

    /**
     * Constructor.
     *
     * @param object $qtype The question type.
     * @param context $context The relevant context.
     */
    public function __construct($qtype, $context) {
        $icon = new pix_icon('icon', $qtype->local_name(), $qtype->plugin_name(), [
            'class' => 'icon',
            'title' => $qtype->local_name()
        ]);
        $help = new lang_string('pluginnamesummary', $qtype->plugin_name());
        parent::__construct($qtype->plugin_name(), $qtype->menu_name(), $qtype->name(), $icon, $help, $context);
    }

}
