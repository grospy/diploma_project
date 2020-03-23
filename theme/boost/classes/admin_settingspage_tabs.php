<?php
//

/**
 * @package   theme_boost
 * @copyright 2016 Ryan Wyllie
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * @package   theme_boost
 * @copyright 2016 Ryan Wyllie
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_boost_admin_settingspage_tabs extends admin_settingpage {

    /** @var The tabs */
    protected $tabs = array();

    /**
     * Add a tab.
     *
     * @param admin_settingpage $tab A tab.
     */
    public function add_tab(admin_settingpage $tab) {
        foreach ($tab->settings as $setting) {
            $this->settings->{$setting->name} = $setting;
        }
        $this->tabs[] = $tab;
        return true;
    }

    public function add($tab) {
        return $this->add_tab($tab);
    }

    /**
     * Get tabs.
     *
     * @return array
     */
    public function get_tabs() {
        return $this->tabs;
    }

    /**
     * Generate the HTML output.
     *
     * @return string
     */
    public function output_html() {
        global $OUTPUT;

        $activetab = optional_param('activetab', '', PARAM_TEXT);
        $context = array('tabs' => array());
        $havesetactive = false;

        foreach ($this->get_tabs() as $tab) {
            $active = false;

            // Default to first tab it not told otherwise.
            if (empty($activetab) && !$havesetactive) {
                $active = true;
                $havesetactive = true;
            } else if ($activetab === $tab->name) {
                $active = true;
            }

            $context['tabs'][] = array(
                'name' => $tab->name,
                'displayname' => $tab->visiblename,
                'html' => $tab->output_html(),
                'active' => $active,
            );
        }

        if (empty($context['tabs'])) {
            return '';
        }

        return $OUTPUT->render_from_template('theme_boost/admin_setting_tabs', $context);
    }

}

