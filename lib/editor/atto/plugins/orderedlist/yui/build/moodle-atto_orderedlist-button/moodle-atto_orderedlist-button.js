YUI.add('moodle-atto_orderedlist-button', function (Y, NAME) {

//

/*
 * @package    atto_orderedlist
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_orderedlist-button
 */

/**
 * Atto text editor orderedlist plugin.
 *
 * @namespace M.atto_orderedlist
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_orderedlist').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'insertOrderedList',
            icon: 'e/numbered_list',

            // Watch the following tags and add/remove highlighting as appropriate:
            tags: 'ol'
        });
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
