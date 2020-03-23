//

/**
 * Icon System base module.
 *
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {

    /**
     * Icon System abstract class.
     *
     * Any icon system needs to define a module extending this one and return this module name from the php icon_system class.
     */
    var IconSystem = function() {
    };

    /**
     * Initialise the icon system.
     *
     * @return {Promise}
     * @method init
     */
    IconSystem.prototype.init = function() {
        return $.when(this);
    };

    /**
     * Render an icon.
     *
     * The key, component and title come from either the pix mustache helper tag, or the call to templates.renderIcon.
     * The template is the pre-loaded template string matching the template from getTemplateName() in this class.
     * This function must return a string (not a promise) because it is used during the internal rendering of the mustache
     * template (which is unfortunately synchronous). To render the mustache template in this function call
     * core/mustache.render() directly and do not use any partials, blocks or helper functions in the template.
     *
     * @param {String} key
     * @param {String} component
     * @param {String} title
     * @param {String} template
     * @return {String}
     * @method renderIcon
     */
    IconSystem.prototype.renderIcon = function(key, component, title, template) { // eslint-disable-line no-unused-vars
        throw new Error('Abstract function not implemented.');
    };

    /**
     * getTemplateName
     *
     * @return {String}
     * @method getTemplateName
     */
    IconSystem.prototype.getTemplateName = function() {
        throw new Error('Abstract function not implemented.');
    };

    return /** @alias module:core/icon_system */ IconSystem;
});
