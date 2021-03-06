//

/**
 * Provides a list of events that can be triggered in the LTI management
 * page.
 *
 * @module     mod_lti/events
 * @class      events
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.1
 */
define([], function() {
    return /** @alias module:mod_lti/events */ {
        NEW_TOOL_TYPE: 'lti.tool.type.new',
        START_EXTERNAL_REGISTRATION: 'lti.registration.external.start',
        STOP_EXTERNAL_REGISTRATION: 'lti.registration.external.stop',
        START_CARTRIDGE_REGISTRATION: 'lti.registration.cartridge.start',
        STOP_CARTRIDGE_REGISTRATION: 'lti.registration.cartridge.stop',
        REGISTRATION_FEEDBACK: 'lti.registration.feedback',
        CAPABILITIES_AGREE: 'lti.tool.type.capabilities.agree',
        CAPABILITIES_DECLINE: 'lti.tool.type.capabilities.decline',
    };
});
