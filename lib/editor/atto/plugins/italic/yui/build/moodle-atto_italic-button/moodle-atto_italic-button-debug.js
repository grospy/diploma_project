YUI.add('moodle-atto_italic-button', function (Y, NAME) {

//

/*
 * @package    atto_italic
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module     moodle-atto_italic-button
 */

/**
 * Atto text editor italic plugin.
 *
 * @namespace M.atto_italic
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_italic').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'italic',

            // Key code for the keyboard shortcut which triggers this button:
            keys: '73',

            // Watch the following tags and add/remove highlighting as appropriate:
            tags: 'i'
        });
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
