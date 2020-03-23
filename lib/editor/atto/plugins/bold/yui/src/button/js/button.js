//

/*
 * @package    atto_bold
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_bold-button
 */

/**
 * Atto text editor bold plugin.
 *
 * @namespace M.atto_bold
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_bold').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'bold',

            // Key code for the keyboard shortcut which triggers this button:
            keys: '66',

            // Watch the following tags and add/remove highlighting as appropriate:
            tags: 'b, strong'
        });
    }
});
