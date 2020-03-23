//

/**
 * Evidence delete.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery',
        'core/notification',
        'core/ajax',
        'core/str',
        'core/log'],
        function($, Notification, Ajax, Str, Log) {

    var selectors = {};

    /**
     * Register an event listener.
     *
     * @param {String} triggerSelector The node on which the click will happen.
     * @param {String} containerSelector The parent node that will be removed and contains the evidence ID.
     */
    var register = function(triggerSelector, containerSelector) {
        if (typeof selectors[triggerSelector] !== 'undefined') {
            return;
        }

        selectors[triggerSelector] = $('body').delegate(triggerSelector, 'click', function(e) {
            var parent = $(e.currentTarget).parents(containerSelector);
            if (!parent.length || parent.length > 1) {
                Log.error('None or too many evidence container were found.');
                return;
            }
            var evidenceId = parent.data('id');
            if (!evidenceId) {
                Log.error('Evidence ID was not found.');
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            Str.get_strings([
                {key: 'confirm', component: 'moodle'},
                {key: 'areyousure', component: 'moodle'},
                {key: 'delete', component: 'moodle'},
                {key: 'cancel', component: 'moodle'}
            ]).done(function(strings) {
                Notification.confirm(
                    strings[0], // Confirm.
                    strings[1], // Are you sure?
                    strings[2], // Delete.
                    strings[3], // Cancel.
                    function() {
                        var promise = Ajax.call([{
                            methodname: 'core_competency_delete_evidence',
                            args: {
                                id: evidenceId
                            }
                        }]);
                        promise[0].then(function() {
                            parent.remove();
                            return;
                        }).fail(Notification.exception);
                    }
                );
            }).fail(Notification.exception);


        });
    };

    return /** @alias module:tool_lp/evidence_delete */ {

        /**
         * Register an event listener.
         *
         * @param {String} triggerSelector The node on which the click will happen.
         * @param {String} containerSelector The parent node that will be removed and contains the evidence ID.
         * @return {Void}
         */
        register: register
    };

});
