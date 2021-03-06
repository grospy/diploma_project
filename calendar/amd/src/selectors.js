//

/**
 * This module is responsible for the calendar filter.
 *
 * @module     core_calendar/calendar_selectors
 * @package    core_calendar
 * @copyright  2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        eventFilterItem: "[data-action='filter-event-type']",
        eventType: {
            site: "[data-eventtype-site]",
            category: "[data-eventtype-category]",
            course: "[data-eventtype-course]",
            group: "[data-eventtype-group]",
            user: "[data-eventtype-user]",
        },
        popoverType: {
            site: "[data-popover-eventtype-site]",
            category: "[data-popover-eventtype-category]",
            course: "[data-popover-eventtype-course]",
            group: "[data-popover-eventtype-group]",
            user: "[data-popover-eventtype-user]",
        },
        calendarPeriods: {
            month: "[data-period='month']",
        },
        courseSelector: 'select[name="course"]',
        viewSelector: 'div[data-region="view-selector"]',
        actions: {
            create: '[data-action="new-event-button"]',
            edit: '[data-action="edit"]',
            remove: '[data-action="delete"]',
            viewEvent: '[data-action="view-event"]',
        },
        elements: {
            courseSelector: 'select[name="course"]',
        },
        today: '.today',
        day: '[data-region="day"]',
        calendarMain: '[data-region="calendar"]',
        wrapper: '.calendarwrapper',
        eventItem: '[data-type="event"]',
        links: {
            navLink: '.calendarwrapper .arrow_link',
            eventLink: "[data-region='event-item']",
            miniDayLink: "[data-region='mini-day-link']",
        },
        containers: {
            loadingIcon: '[data-region="overlay-icon-container"]',
        },
    };
});
