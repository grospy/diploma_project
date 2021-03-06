//

/**
 * Edit items in feedback module
 *
 * @module     mod_feedback/edit
 * @package    mod_feedback
 * @copyright  2016 Marina Glancy
 */
define(['jquery', 'core/ajax', 'core/str', 'core/notification'],
function($, ajax, str, notification) {
    var manager = {
        deleteItem: function(e) {
            e.preventDefault();
            var targetUrl = $(e.currentTarget).attr('href');

            str.get_strings([
                {
                    key:        'confirmation',
                    component:  'admin'
                },
                {
                    key:        'confirmdeleteitem',
                    component:  'mod_feedback'
                },
                {
                    key:        'yes',
                    component:  'moodle'
                },
                {
                    key:        'no',
                    component:  'moodle'
                }
            ])
            .then(function(s) {
                notification.confirm(s[0], s[1], s[2], s[3], function() {
                    window.location = targetUrl;
                });

                return;
            })
            .catch();
        },

        setup: function() {
            $('body').delegate('[data-action="delete"]', 'click', manager.deleteItem);
        }
    };

    return {
        setup: manager.setup
    };
});
