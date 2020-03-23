//

/**
 * Wrapper for the YUI M.core.notification class. Allows us to
 * use the YUI version in AMD code until it is replaced.
 *
 * @module     tool_lp/dialogue
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/yui'], function(Y) {

    // Private variables and functions.
    /**
     * Constructor
     *
     * @param {String} title Title for the window.
     * @param {String} content The content for the window.
     * @param {function} afterShow Callback executed after the window is opened.
     * @param {function} afterHide Callback executed after the window is closed.
     * @param {Boolean} wide Specify we want an extra wide dialogue (the size is standard, but wider than the default).
     */
    var dialogue = function(title, content, afterShow, afterHide, wide) {
        this.yuiDialogue = null;
        var parent = this;

        // Default for wide is false.
        if (typeof wide == 'undefined') {
            wide = false;
        }

        Y.use('moodle-core-notification', 'timers', function() {
            var width = '480px';
            if (wide) {
                width = '800px';
            }

            parent.yuiDialogue = new M.core.dialogue({
                headerContent: title,
                bodyContent: content,
                draggable: true,
                visible: false,
                center: true,
                modal: true,
                width: width
            });

            parent.yuiDialogue.after('visibleChange', function(e) {
                if (e.newVal) {
                    // Delay the callback call to the next tick, otherwise it can happen that it is
                    // executed before the dialogue constructor returns.
                    if ((typeof afterShow !== 'undefined')) {
                        Y.soon(function() {
                            afterShow(parent);
                            parent.yuiDialogue.centerDialogue();
                        });
                    }
                } else {
                    if ((typeof afterHide !== 'undefined')) {
                        Y.soon(function() {
                            afterHide(parent);
                        });
                    }
                }
            });

            parent.yuiDialogue.show();
        });
    };

    /**
     * Close this window.
     */
    dialogue.prototype.close = function() {
        this.yuiDialogue.hide();
        this.yuiDialogue.destroy();
    };

    /**
     * Get content.
     * @return {node}
     */
    dialogue.prototype.getContent = function() {
        return this.yuiDialogue.bodyNode.getDOMNode();
    };

    return /** @alias module:tool_lp/dialogue */ dialogue;
});
