//

/**
 * Competency rule all module.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery',
        'core/str',
        'tool_lp/competency_rule',
        ],
        function($, Str, RuleBase) {

    /**
     * Competency rule all class.
     */
    var Rule = function() {
        RuleBase.apply(this, arguments);
    };
    Rule.prototype = Object.create(RuleBase.prototype);

    /**
     * Return the type of the module.
     *
     * @return {String}
     * @method getType
     */
    Rule.prototype.getType = function() {
        return 'core_competency\\competency_rule_all';
    };

    /**
     * Whether or not the current config is valid.
     *
     * @return {Boolean}
     * @method isValid
     */
    Rule.prototype.isValid = function() {
        return true;
    };

    return /** @alias module:tool_lp/competency_rule_all */ Rule;

});
