<?php
//

/**
 * Page helper.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy;
use context_system;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * Page helper.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class page_helper {

    /**
     * Sets up $PAGE for data privacy admin pages.
     *
     * @param moodle_url $url The page URL.
     * @param string $title The page's title.
     * @param string $attachtoparentnode The parent navigation node where this page can be accessed from.
     * @param string $requiredcapability The required capability to view this page.
     */
    public static function setup(moodle_url $url, $title, $attachtoparentnode = '',
                                 $requiredcapability = 'tool/dataprivacy:managedataregistry') {
        global $PAGE, $SITE;

        $context = context_system::instance();

        require_login();
        if (isguestuser()) {
            print_error('noguest');
        }

        // TODO Check that data privacy is enabled.
        require_capability($requiredcapability, $context);

        $PAGE->navigation->override_active_url($url);

        $PAGE->set_url($url);
        $PAGE->set_context($context);
        $PAGE->set_pagelayout('admin');
        $PAGE->set_title($title);
        $PAGE->set_heading($SITE->fullname);

        // If necessary, override the settings navigation to add this page into the breadcrumb navigation.
        if ($attachtoparentnode) {
            if ($siteadmin = $PAGE->settingsnav->find('root', \navigation_node::TYPE_SITE_ADMIN)) {
                $PAGE->navbar->add($siteadmin->get_content(), $siteadmin->action());
            }
            if ($dataprivacy = $PAGE->settingsnav->find('privacy', \navigation_node::TYPE_SETTING)) {
                $PAGE->navbar->add($dataprivacy->get_content(), $dataprivacy->action());
            }
            if ($dataregistry = $PAGE->settingsnav->find($attachtoparentnode, \navigation_node::TYPE_SETTING)) {
                $PAGE->navbar->add($dataregistry->get_content(), $dataregistry->action());
            }

            $PAGE->navbar->add($title, $url);
        }
    }
}
