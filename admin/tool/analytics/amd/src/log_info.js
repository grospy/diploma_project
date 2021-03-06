//

/**
 * Shows a dialogue with info about this logs.
 *
 * @module     tool_analytics/log_info
 * @class      log_info
 * @package    tool_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/str', 'core/modal_factory', 'core/notification'], function($, str, ModalFactory, Notification) {

    return /** @alias module:tool_analytics/log_info */ {

        /**
         * Prepares a modal info for a log's results.
         *
         * @method loadInfo
         * @param {int} id
         * @param {string[]} info
         */
        loadInfo: function(id, info) {

            var link = $('[data-model-log-id="' + id + '"]');
            str.get_string('loginfo', 'tool_analytics').then(function(langString) {

                var bodyInfo = $("<ul>");
                info.forEach(function(item) {
                    bodyInfo.append('<li>' + item + '</li>');
                });
                bodyInfo.append("</ul>");

                return ModalFactory.create({
                    title: langString,
                    body: bodyInfo.html(),
                    large: true,
                }, link);

            }).catch(Notification.exception);
        }
    };
});
