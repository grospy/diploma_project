//

/**
 * Javascript to load and render a paged content section.
 *
 * @module     core/paged_content
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
[
    'jquery',
    'core/paged_content_pages',
    'core/paged_content_paging_bar',
    'core/paged_content_paging_bar_limit_selector',
    'core/paged_content_paging_dropdown'
],
function(
    $,
    Pages,
    PagingBar,
    PagingBarLimitSelector,
    Dropdown
) {

    /**
     * Initialise the paged content region by running the pages
     * module and initialising any paging controls in the DOM.
     *
     * @param {object} root The paged content container element
     * @param {function} renderPagesContentCallback (optional) A callback function to render a
     *                                              content page. See core/paged_content_pages for
     *                                              more defails.
     * @param {string} namespaceOverride (optional) Provide a unique namespace override. If none provided defaults
     *                                      to generate html's id
     */
    var init = function(root, renderPagesContentCallback, namespaceOverride) {
        root = $(root);
        var pagesContainer = root.find(Pages.rootSelector);
        var pagingBarContainer = root.find(PagingBar.rootSelector);
        var dropdownContainer = root.find(Dropdown.rootSelector);
        var pagingBarLimitSelectorContainer = root.find(PagingBarLimitSelector.rootSelector);
        var id = root.attr('id');

        // Set the id to the custom namespace provided
        if (namespaceOverride) {
            id = namespaceOverride;
        }

        Pages.init(pagesContainer, id, renderPagesContentCallback);

        if (pagingBarContainer.length) {
            PagingBar.init(pagingBarContainer, id);
        }

        if (pagingBarLimitSelectorContainer.length) {
            PagingBarLimitSelector.init(pagingBarLimitSelectorContainer, id);
        }

        if (dropdownContainer.length) {
            Dropdown.init(dropdownContainer, id);
        }
    };

    return {
        init: init,
        rootSelector: '[data-region="paged-content-container"]'
    };
});
