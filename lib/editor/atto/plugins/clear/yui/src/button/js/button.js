//

/*
 * @package    atto_clear
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_clear-button
 */

/**
 * Atto text editor clear plugin.
 *
 * @namespace M.atto_clear
 * @class button
 * @extends M.editor_atto.EditorPlugin
 */

Y.namespace('M.atto_clear').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    initializer: function() {
        this.addBasicButton({
            exec: 'removeFormat',
            icon: 'e/clear_formatting'
        });
    }
});
