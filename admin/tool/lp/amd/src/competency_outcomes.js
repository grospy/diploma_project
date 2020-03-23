//

/**
 * Competency rule config.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery',
        'core/str'],
        function($, Str) {

    var OUTCOME_NONE = 0,
        OUTCOME_EVIDENCE = 1,
        OUTCOME_COMPLETE = 2,
        OUTCOME_RECOMMEND = 3;

    return /** @alias module:tool_lp/competency_outcomes */ {

        NONE: OUTCOME_NONE,
        EVIDENCE: OUTCOME_EVIDENCE,
        COMPLETE: OUTCOME_COMPLETE,
        RECOMMEND: OUTCOME_RECOMMEND,

        /**
         * Get all the outcomes.
         *
         * @return {Object} Indexed by outcome code, contains code and name.
         * @method getAll
         */
        getAll: function() {
            var self = this;
            return Str.get_strings([
                {key: 'competencyoutcome_none', component: 'tool_lp'},
                {key: 'competencyoutcome_evidence', component: 'tool_lp'},
                {key: 'competencyoutcome_recommend', component: 'tool_lp'},
                {key: 'competencyoutcome_complete', component: 'tool_lp'},
            ]).then(function(strings) {
                var outcomes = {};
                outcomes[self.NONE] = {code: self.NONE, name: strings[0]};
                outcomes[self.EVIDENCE] = {code: self.EVIDENCE, name: strings[1]};
                outcomes[self.RECOMMEND] = {code: self.RECOMMEND, name: strings[2]};
                outcomes[self.COMPLETE] = {code: self.COMPLETE, name: strings[3]};
                return outcomes;
            });
        },

        /**
         * Get the string for an outcome.
         *
         * @param  {Number} id The outcome code.
         * @return {Promise} Resolved with the string.
         * @method getString
         */
        getString: function(id) {
            var self = this,
                all = self.getAll();

            return all.then(function(outcomes) {
                if (typeof outcomes[id] === 'undefined') {
                    return $.Deferred().reject().promise();
                }
                return outcomes[id].name;
            });
        }
    };

});
