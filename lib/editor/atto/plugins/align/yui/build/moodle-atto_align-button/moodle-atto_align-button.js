YUI.add('moodle-atto_align-button', function (Y, NAME) {

//

/*
 * @package    atto_align
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_align-button
 */

/**
 * Atto text editor align plugin.
 *
 * @namespace M.atto_align
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_align').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        var alignment;

        alignment = 'justifyLeft';
        this.addButton({
            icon: 'e/align_left',
            title: 'leftalign',
            buttonName: alignment,
            callback: this._changeStyle,
            callbackArgs: alignment
        });

        alignment = 'justifyCenter';
        this.addButton({
            icon: 'e/align_center',
            title: 'center',
            buttonName: alignment,
            callback: this._changeStyle,
            callbackArgs: alignment
        });

        alignment = 'justifyRight';
        this.addButton({
            icon: 'e/align_right',
            title: 'rightalign',
            buttonName: alignment,
            callback: this._changeStyle,
            callbackArgs: alignment
        });
    },


    /**
     * Change the alignment to the specified justification.
     *
     * @method _changeStyle
     * @param {EventFacade} e
     * @param {string} justification The execCommand for the new justification.
     * @private
     */
    _changeStyle: function(e, justification) {
        var host = this.get('host');

        // We temporarily re-enable CSS styling to try to have the most consistency.
        // Though, IE, as always, is stubborn and will do its own thing...
        host.enableCssStyling();

        document.execCommand(justification, false, null);

        // Re-disable the CSS styling after making the change.
        host.disableCssStyling();

        // Mark the text as having been updated.
        this.markUpdated();

        this.editor.focus();
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
