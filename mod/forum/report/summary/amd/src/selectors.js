//

/**
 * Module containing the selectors for the forum summary report.
 *
 * @module     forumreport_summary/selectors
 * @package    forumreport_summary
 * @copyright  2019 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

export default {
    filters: {
        group: {
            checkbox: '[data-region="filter-groups"] input[type="checkbox"]',
            clear: '[data-region="filter-groups"] .filter-clear',
            popover: '#filter-groups-popover',
            save: '[data-region="filter-groups"] .filter-save',
            selectall: '[data-region="filter-groups"] .select-all',
            trigger: '#filter-groups-button',
        },
        date: {
            calendar: '#dateselector-calendar-panel',
            calendariconfrom: '#id_filterdatefrompopover_calendar',
            calendariconto: '#id_filterdatetopopover_calendar',
            popover: '#filter-dates-popover',
            save: '[data-region="filter-dates"] .filter-save',
            trigger: '#filter-dates-button',
        },
        exportlink: {
            link: '#summaryreport #forumreport_summary_table button.export-link'
        }
    }
};
