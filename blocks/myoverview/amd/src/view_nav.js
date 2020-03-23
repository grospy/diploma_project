//

/**
 * Manage the timeline view navigation for the overview block.
 *
 * @package    block_myoverview
 * @copyright  2018 Bas Brands <bas@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(
[
    'jquery',
    'core/custom_interaction_events',
    'block_myoverview/repository',
    'block_myoverview/view',
    'block_myoverview/selectors'
],
function(
    $,
    CustomEvents,
    Repository,
    View,
    Selectors
) {

    var SELECTORS = {
        FILTERS: '[data-region="filter"]',
        FILTER_OPTION: '[data-filter]',
        DISPLAY_OPTION: '[data-display-option]'
    };

    /**
     * Update the user preference for the block.
     *
     * @param {String} filter The type of filter: display/sort/grouping.
     * @param {String} value The current preferred value.
     */
    var updatePreferences = function(filter, value) {
        var type = null;
        if (filter == 'display') {
            type = 'block_myoverview_user_view_preference';
        } else if (filter == 'sort') {
            type = 'block_myoverview_user_sort_preference';
        } else if (filter == 'customfieldvalue') {
            type = 'block_myoverview_user_grouping_customfieldvalue_preference';
        } else {
            type = 'block_myoverview_user_grouping_preference';
        }

        Repository.updateUserPreferences({
            preferences: [
                {
                    type: type,
                    value: value
                }
            ]
        });
    };

    /**
     * Event listener for the Display filter (cards, list).
     *
     * @param {object} root The root element for the overview block
     */
    var registerSelector = function(root) {

        var Selector = root.find(SELECTORS.FILTERS);

        CustomEvents.define(Selector, [CustomEvents.events.activate]);
        Selector.on(
            CustomEvents.events.activate,
            SELECTORS.FILTER_OPTION,
            function(e, data) {
                var option = $(e.target);

                if (option.hasClass('active')) {
                    // If it's already active then we don't need to do anything.
                    return;
                }

                var filter = option.attr('data-filter');
                var pref = option.attr('data-pref');
                var customfieldvalue = option.attr('data-customfieldvalue');

                root.find(Selectors.courseView.region).attr('data-' + filter, option.attr('data-value'));
                updatePreferences(filter, pref);

                if (customfieldvalue) {
                    root.find(Selectors.courseView.region).attr('data-customfieldvalue', customfieldvalue);
                    updatePreferences('customfieldvalue', customfieldvalue);
                }

                // Reset the views.
                View.init(root);

                data.originalEvent.preventDefault();
            }
        );

        CustomEvents.define(Selector, [CustomEvents.events.activate]);
        Selector.on(
            CustomEvents.events.activate,
            SELECTORS.DISPLAY_OPTION,
            function(e, data) {
                var option = $(e.target);

                if (option.hasClass('active')) {
                    return;
                }

                var filter = option.attr('data-display-option');
                var pref = option.attr('data-pref');

                root.find(Selectors.courseView.region).attr('data-display', option.attr('data-value'));
                updatePreferences(filter, pref);
                View.reset(root);
                data.originalEvent.preventDefault();
            }
        );
    };

    /**
     * Initialise the timeline view navigation by adding event listeners to
     * the navigation elements.
     *
     * @param {object} root The root element for the myoverview block
     */
    var init = function(root) {
        root = $(root);
        registerSelector(root);
    };

    return {
        init: init
    };
});
