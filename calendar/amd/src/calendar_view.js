//

/**
 * This module is responsible for handle calendar day and upcoming view.
 *
 * @module     core_calendar/calendar
 * @package    core_calendar
 * @copyright  2017 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
        'jquery',
        'core/str',
        'core/notification',
        'core_calendar/selectors',
        'core_calendar/events',
        'core_calendar/view_manager',
        'core_calendar/repository',
        'core/modal_factory',
        'core_calendar/modal_event_form',
        'core/modal_events',
        'core_calendar/crud'
    ],
    function(
        $,
        Str,
        Notification,
        CalendarSelectors,
        CalendarEvents,
        CalendarViewManager,
        CalendarRepository,
        ModalFactory,
        ModalEventForm,
        ModalEvents,
        CalendarCrud
    ) {

        var registerEventListeners = function(root, type) {
            var body = $('body');

            CalendarCrud.registerRemove(root);

            var reloadFunction = 'reloadCurrent' + type.charAt(0).toUpperCase() + type.slice(1);

            body.on(CalendarEvents.created, function() {
                CalendarViewManager[reloadFunction](root);
            });
            body.on(CalendarEvents.deleted, function() {
                CalendarViewManager[reloadFunction](root);
            });
            body.on(CalendarEvents.updated, function() {
                CalendarViewManager[reloadFunction](root);
            });

            root.on('change', CalendarSelectors.courseSelector, function() {
                var selectElement = $(this);
                var courseId = selectElement.val();
                CalendarViewManager[reloadFunction](root, courseId, null)
                    .then(function() {
                        // We need to get the selector again because the content has changed.
                        return root.find(CalendarSelectors.courseSelector).val(courseId);
                    })
                    .then(function() {
                        window.history.pushState({}, '', '?view=upcoming&course=' + courseId);

                        return;
                    })
                    .fail(Notification.exception);
            });

            body.on(CalendarEvents.filterChanged, function(e, data) {
                var daysWithEvent = root.find(CalendarSelectors.eventType[data.type]);
                if (data.hidden == true) {
                    daysWithEvent.addClass('hidden');
                } else {
                    daysWithEvent.removeClass('hidden');
                }
            });

            var eventFormPromise = CalendarCrud.registerEventFormModal(root);
            CalendarCrud.registerEditListeners(root, eventFormPromise);
        };

        return {
            init: function(root, type) {
                root = $(root);

                CalendarViewManager.init(root, type);
                registerEventListeners(root, type);
            }
        };
    });
