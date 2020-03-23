<?php

//

/**
 * Url module admin settings and defaults
 *
 * @package    mod_url
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once("$CFG->libdir/resourcelib.php");

    $displayoptions = resourcelib_get_displayoptions(array(RESOURCELIB_DISPLAY_AUTO,
                                                           RESOURCELIB_DISPLAY_EMBED,
                                                           RESOURCELIB_DISPLAY_FRAME,
                                                           RESOURCELIB_DISPLAY_OPEN,
                                                           RESOURCELIB_DISPLAY_NEW,
                                                           RESOURCELIB_DISPLAY_POPUP,
                                                          ));
    $defaultdisplayoptions = array(RESOURCELIB_DISPLAY_AUTO,
                                   RESOURCELIB_DISPLAY_EMBED,
                                   RESOURCELIB_DISPLAY_OPEN,
                                   RESOURCELIB_DISPLAY_POPUP,
                                  );

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_configtext('url/framesize',
        get_string('framesize', 'url'), get_string('configframesize', 'url'), 130, PARAM_INT));
    $settings->add(new admin_setting_configpasswordunmask('url/secretphrase', get_string('password'),
        get_string('configsecretphrase', 'url'), ''));
    $settings->add(new admin_setting_configcheckbox('url/rolesinparams',
        get_string('rolesinparams', 'url'), get_string('configrolesinparams', 'url'), false));
    $settings->add(new admin_setting_configmultiselect('url/displayoptions',
        get_string('displayoptions', 'url'), get_string('configdisplayoptions', 'url'),
        $defaultdisplayoptions, $displayoptions));

    //--- modedit defaults -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('urlmodeditdefaults', get_string('modeditdefaults', 'admin'), get_string('condifmodeditdefaults', 'admin')));

    $settings->add(new admin_setting_configcheckbox('url/printintro',
        get_string('printintro', 'url'), get_string('printintroexplain', 'url'), 1));
    $settings->add(new admin_setting_configselect('url/display',
        get_string('displayselect', 'url'), get_string('displayselectexplain', 'url'), RESOURCELIB_DISPLAY_AUTO, $displayoptions));
    $settings->add(new admin_setting_configtext('url/popupwidth',
        get_string('popupwidth', 'url'), get_string('popupwidthexplain', 'url'), 620, PARAM_INT, 7));
    $settings->add(new admin_setting_configtext('url/popupheight',
        get_string('popupheight', 'url'), get_string('popupheightexplain', 'url'), 450, PARAM_INT, 7));
}
