//

/**
 * A way to call HTML fragments to be inserted as required via JavaScript.
 *
 * @module     core/fragment
 * @class      fragment
 * @package    core
 * @copyright  2016 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.1
 */
define(['jquery', 'core/ajax'], function($, ajax) {

    /**
     * Loads an HTML fragment through a callback.
     *
     * @method loadFragment
     * @param {string} component Component where callback is located.
     * @param {string} callback Callback function name.
     * @param {integer} contextid Context ID of the fragment.
     * @param {object} params Parameters for the callback.
     * @return {Promise} JQuery promise object resolved when the fragment has been loaded.
     */
    var loadFragment = function(component, callback, contextid, params) {
        // Change params into required webservice format.
        var formattedparams = [];
        for (var index in params) {
            formattedparams.push({
                name: index,
                value: params[index]
            });
        }

        return ajax.call([{
            methodname: 'core_get_fragment',
            args: {
                component: component,
                callback: callback,
                contextid: contextid,
                args: formattedparams
            }
        }])[0];
    };

    return /** @alias module:core/fragment */{
        /**
         * Appends HTML and JavaScript fragments to specified nodes.
         * Callbacks called by this AMD module are responsible for doing the appropriate security checks
         * to access the information that is returned. This only does minimal validation on the context.
         *
         * @method fragmentAppend
         * @param {string} component Component where callback is located.
         * @param {string} callback Callback function name.
         * @param {integer} contextid Context ID of the fragment.
         * @param {object} params Parameters for the callback.
         * @return {Deferred} new promise that is resolved with the html and js.
         */
        loadFragment: function(component, callback, contextid, params) {
            var promise = $.Deferred();
            loadFragment(component, callback, contextid, params).then(function(data) {
                var jsNodes = $(data.javascript);
                var allScript = '';
                jsNodes.each(function(index, scriptNode) {
                    scriptNode = $(scriptNode);
                    var tagName = scriptNode.prop('tagName');
                    if (tagName && (tagName.toLowerCase() == 'script')) {
                        if (scriptNode.attr('src')) {
                            // We only reload the script if it was not loaded already.
                            var exists = false;
                            $('script').each(function(index, s) {
                                if ($(s).attr('src') == scriptNode.attr('src')) {
                                    exists = true;
                                }
                                return !exists;
                            });
                            if (!exists) {
                                allScript += ' { ';
                                allScript += ' node = document.createElement("script"); ';
                                allScript += ' node.type = "text/javascript"; ';
                                allScript += ' node.src = decodeURI("' + encodeURI(scriptNode.attr('src')) + '"); ';
                                allScript += ' document.getElementsByTagName("head")[0].appendChild(node); ';
                                allScript += ' } ';
                            }
                        } else {
                            allScript += ' ' + scriptNode.text();
                        }
                    }
                });
                promise.resolve(data.html, allScript);
                return;
            }).fail(function(ex) {
                promise.reject(ex);
            });
            return promise.promise();
        }
    };
});
