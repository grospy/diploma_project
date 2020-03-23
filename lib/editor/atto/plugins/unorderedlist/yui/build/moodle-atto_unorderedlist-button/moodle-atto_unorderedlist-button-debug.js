YUI.add('moodle-atto_unorderedlist-button', function (Y, NAME) {

//

/*
 * @package    atto_unorderedlist
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module     moodle-atto_unorderedlist-button
 */

/**
 * Atto text editor unorderedlist plugin.
 *
 * @namespace M.atto_unorderedlist
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_unorderedlist').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'insertUnorderedList',
            icon: 'e/bullet_list',

            // Watch the following tags and add/remove highlighting as appropriate:
            tags: 'ul'
        });
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
