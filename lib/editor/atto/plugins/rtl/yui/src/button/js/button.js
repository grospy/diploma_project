//

/*
 * @package    atto_rtl
 * @copyright  2014 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_rtl-button
 */

/**
 * Atto text editor rtl plugin.
 *
 * @namespace M.atto_rtl
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_rtl').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        var direction;

        direction = 'ltr';
        this.addButton({
            icon: 'e/left_to_right',
            title: direction,
            buttonName: direction,
            callback: this._toggleRTL,
            callbackArgs: direction,
            tags: '[dir=ltr]'
        });

        direction = 'rtl';
        this.addButton({
            icon: 'e/right_to_left',
            title: direction,
            buttonName: direction,
            callback: this._toggleRTL,
            callbackArgs: direction,
            tags: '[dir=rtl]'
        });
    },

    /**
     * Toggle the RTL/LTR values based on the supplied direction.
     *
     * @method _toggleRTL
     * @param {EventFacade} e
     * @param {String} direction
     */
    _toggleRTL: function(e, direction) {
        var host = this.get('host'),
            sourceSelection = window.rangy.saveSelection(),
            selection = host.getSelection(),
            newDirection = {
                rtl: 'ltr',
                ltr: 'rtl'
            };
        if (selection) {
            // Format the selection to be sure it has a tag parent (not the contenteditable).
            var parentNode = host.formatSelectionBlock(),
                parentDOMNode = parentNode.getDOMNode();

            var currentDirection = parentDOMNode.getAttribute('dir');
            if (currentDirection === direction) {
                parentDOMNode.setAttribute("dir", newDirection[direction]);
            } else {
                parentDOMNode.setAttribute("dir", direction);
            }

            // Change selection from the containing paragraph to the original one.
            window.rangy.restoreSelection(sourceSelection);
            // Mark the text as having been updated.
            this.markUpdated();
        }
    }
});
