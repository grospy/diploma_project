//

/*
 * @package    atto_emojipicker
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_emojipicker-button
 */
var COMPONENTNAME = 'atto_emojipicker';

/**
 * Atto text editor emoji picker plugin.
 *
 * @namespace M.atto_emojipicker
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_emojipicker').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {

    /**
     * A reference to the current selection at the time that the dialogue
     * was opened.
     *
     * @property _currentSelection
     * @type Range
     * @private
     */
    _currentSelection: null,

    initializer: function() {
        if (this.get('disabled')) {
            return;
        }

        this.addButton({
            icon: 'e/emoticons',
            callback: this._displayDialogue
        });
    },

    /**
     * Display the emoji picker.
     *
     * @method _displayDialogue
     * @private
     */
    _displayDialogue: function() {
        // Store the current selection.
        this._currentSelection = this.get('host').getSelection();
        if (this._currentSelection === false) {
            return;
        }

        var dialogue = this.getDialogue({
            headerContent: M.util.get_string('emojipicker', COMPONENTNAME),
            width: 'auto',
            focusAfterHide: true,
            additionalBaseClass: 'emoji-picker-dialogue'
        }, true);

        // Set the dialogue content, and then show the dialogue.
        dialogue.set('bodyContent', this._getDialogueContent())
                .show();
    },

    /**
     * Insert the emoticon.
     *
     * @method _insertEmote
     * @param {String} emoji
     * @private
     */
    _insertEmoji: function(emoji) {
        var host = this.get('host');

        // Hide the dialogue.
        this.getDialogue({
            focusAfterHide: null
        }).hide();

        // Focus on the previous selection.
        host.setSelection(this._currentSelection);

        // And add the character.
        host.insertContentAtFocusPoint(emoji);

        this.markUpdated();
    },

    /**
     * Generates the content of the dialogue, attaching event listeners to
     * the content.
     *
     * @method _getDialogueContent
     * @return {Node} Node containing the dialogue content
     * @private
     */
    _getDialogueContent: function() {
        var wrapper = Y.Node.create('<div></div>');

        require(['core/templates', 'core/emoji/picker'], function(Templates, initialiseEmojiPicker) {
                Templates.render('core/emoji/picker', {}).then(function(html) {
                    var domNode = wrapper.getDOMNode();
                    domNode.innerHTML = html;
                    initialiseEmojiPicker(domNode, this._insertEmoji.bind(this));
                    this.getDialogue().centerDialogue();
                }.bind(this));
        }.bind(this));

        return wrapper;
    }
}, {
    ATTRS: {
        disabled: {
            value: true
        }
    }
});
