//

/**
 * @package    tool
 * @subpackage customlang
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @namespace
 */
M.tool_customlang = M.tool_customlang || {};

/**
 * YUI instance holder
 */
M.tool_customlang.Y = {};

/**
 * Initialize JS support for the edit.php
 *
 * @param {Object} Y YUI instance
 */
M.tool_customlang.init_editor = function(Y) {
    M.tool_customlang.Y = Y;

    Y.all('#translator .local textarea').each(function (textarea) {
        var cell = textarea.get('parentNode');
        textarea.setStyle('height', cell.getComputedStyle('height'));
    });
}
