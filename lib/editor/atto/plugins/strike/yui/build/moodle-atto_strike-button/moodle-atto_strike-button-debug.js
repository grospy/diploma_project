YUI.add('moodle-atto_strike-button', function (Y, NAME) {

//

/*
 * @package    atto_strike
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_strike-button
 */

/**
 * Atto text editor strike plugin.
 *
 * @namespace M.atto_strike
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_strike').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'strikeThrough',
            icon: 'e/strikethrough',

            // Watch the following tags and add/remove highlighting as appropriate:
            tags: 'strike'
        });
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
