//

/*
 * @package    atto_noautolink
 * @copyright  2014 Andrew Davis  <andrew@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_noautolink-button
 */

/**
 * Atto text editor noautolink plugin.
 *
 * @namespace M.atto_noautolink
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_noautolink').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addButton({
            icon: 'e/prevent_autolink',
            callback: this._preventAutoLink,
            inlineFormat: true,
            tags: '.nolink'
        });
    },

    /**
     * Prevent autolinking of the selected region.
     *
     * @method _preventAutoLink
     * @param {EventFacade} e
     * @private
     */
    _preventAutoLink: function() {
        // Toggle inline selection class
        this.get('host').toggleInlineSelectionClass(['nolink']);
    }
});
