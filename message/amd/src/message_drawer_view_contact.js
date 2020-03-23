//

/**
 * Controls the contact page in the message drawer.
 *
 * @module     core_message/message_drawer_view_contact
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
[
    'jquery',
    'core/str',
    'core/templates'
],
function(
    $,
    Str,
    Templates
) {

    var SELECTORS = {
        CONTENT_CONTAINER: '[data-region="content-container"]'
    };

    var TEMPLATES = {
        CONTENT: 'core_message/message_drawer_view_contact_body_content'
    };

    /**
     * Get the content container of the contact view container.
     *
     * @param {Object} root Contact container element.
     * @returns {Object} jQuery object
     */
    var getContentContainer = function(root) {
        return root.find(SELECTORS.CONTENT_CONTAINER);
    };

    /**
     * Render the contact profile in the content container.
     *
     * @param {Object} root Contact container element.
     * @param {Object} profile Contact profile details.
     * @returns {Object} jQuery promise
     */
    var render = function(root, profile) {
        return Templates.render(TEMPLATES.CONTENT, profile)
            .then(function(html) {
                getContentContainer(root).append(html);
                return html;
            });
    };

    /**
     * Setup the contact page.
     *
     * @param {string} namespace The route namespace.
     * @param {Object} header Contact header element.
     * @param {Object} body Contact body container element.
     * @param {Object} footer Contact footer container element.
     * @param {Object} contact The contact object.
     * @returns {Object} jQuery promise
     */
    var show = function(namespace, header, body, footer, contact) {
        var root = $(body);

        getContentContainer(root).empty();
        return render(root, contact);
    };

    /**
     * String describing this page used for aria-labels.
     *
     * @param {Object} root Contact container element.
     * @param {Object} contact The contact object.
     * @return {Object} jQuery promise
     */
    var description = function(root, contact) {
        return Str.get_string('messagedrawerviewcontact', 'core_message', contact.fullname);
    };

    return {
        show: show,
        description: description
    };
});
