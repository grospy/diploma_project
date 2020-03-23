//

/**
 * Competency rule points module.
 *
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['core/icon_system', 'core/url', 'core/mustache'],
        function(IconSystem, CoreUrl, Mustache) {

    /**
     * IconSystemStandard
     */
    var IconSystemStandard = function() {
        IconSystem.apply(this, arguments);
    };
    IconSystemStandard.prototype = Object.create(IconSystem.prototype);

    /**
     * Render an icon.
     *
     * @param {String} key
     * @param {String} component
     * @param {String} title
     * @param {String} template
     * @return {String}
     * @method renderIcon
     */
    IconSystemStandard.prototype.renderIcon = function(key, component, title, template) {
        var url = CoreUrl.imageUrl(key, component);

        var templatecontext = {
            attributes: [
                {name: 'src', value: url},
                {name: 'alt', value: title},
                {name: 'title', value: title}
            ]
        };
        if (typeof title === "undefined" || title == "") {
            templatecontext.attributes.push({name: 'aria-hidden', value: 'true'});
        }

        var result = Mustache.render(template, templatecontext);
        return result.trim();
    };

    /**
     * Get the name of the template to pre-cache for this icon system.
     *
     * @return {String}
     * @method getTemplateName
     */
    IconSystemStandard.prototype.getTemplateName = function() {
        return 'core/pix_icon';
    };

    return /** @alias module:core/icon_system_standard */ IconSystemStandard;

});
