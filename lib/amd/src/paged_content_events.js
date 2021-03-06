//

/**
 * Events for the paged content element.
 *
 * @module     core/paged_content_events
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        SHOW_PAGES: 'core-paged-content-show-pages',
        PAGES_SHOWN: 'core-paged-content-pages-shown',
        ALL_ITEMS_LOADED: 'core-paged-content-all-items-loaded',
        SET_ITEMS_PER_PAGE_LIMIT: 'core-paged-content-set-items-per-page-limit'
    };
});
