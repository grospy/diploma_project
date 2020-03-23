//
//

/**
 * Atto recordrtc library functions for checking browser compatibility
 *
 * @package    atto_recordrtc
 * @author     Jesus Federico (jesus [at] blindsidenetworks [dt] com)
 * @author     Jacob Prud'homme (jacob [dt] prudhomme [at] blindsidenetworks [dt] com)
 * @copyright  2017 Blindside Networks Inc.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// ESLint directives.
/* eslint-disable camelcase */

// Scrutinizer CI directives.
/** global: M */

M.atto_recordrtc = M.atto_recordrtc || {};

// Shorten access to module namespaces.
var cm = M.atto_recordrtc.commonmodule,
    am = M.atto_recordrtc.abstractmodule;

M.atto_recordrtc.compatcheckmodule = {
    // Show alert and close plugin if browser does not support WebRTC at all.
    check_has_gum: function() {
        if (!(navigator.mediaDevices && window.MediaRecorder)) {
            am.show_alert('nowebrtc', function() {
                cm.editorScope.closeDialogue(cm.editorScope);
            });
        }
    },

    // Notify and redirect user if plugin is used from insecure location.
    check_secure: function() {
        var isSecureOrigin = (window.location.protocol === 'https:') ||
                             (window.location.host.indexOf('localhost') !== -1);

        if (!isSecureOrigin) {
            cm.alertDanger.ancestor().ancestor().removeClass('hide');
        }
    },
};
