//

define(['jquery', 'core/sortable_list', 'core/ajax', 'core/notification'], function($, SortableList, Ajax, Notification) {
    return {
        init: function(tableid, moveaction) {
            // Initialise sortable for the given list.
            var sort = new SortableList('#' + tableid + ' tbody');
            sort.getElementName = function(element) {
                return $.Deferred().resolve(element.attr('data-name'));
            };
            var origIndex;
            $('#' + tableid + ' tbody tr').on(SortableList.EVENTS.DRAGSTART, function(_, info) {
                // Remember position of the element in the beginning of dragging.
                origIndex = info.sourceList.children().index(info.element);
                // Resize the "proxy" element to be the same width as the main element.
                setTimeout(function() {
                    $('.sortable-list-is-dragged').width(info.element.width());
                }, 501);
            }).on(SortableList.EVENTS.DROP, function(_, info) {
                // When a list element was moved send AJAX request to the server.
                var newIndex = info.targetList.children().index(info.element);
                var t = info.element.find('[data-action=' + moveaction + ']');
                if (info.positionChanged && t.length) {
                    var request = {
                        methodname: 'tool_xmldb_invoke_move_action',
                        args: {
                            action: moveaction,
                            dir: t.attr('data-dir'),
                            table: t.attr('data-table'),
                            field: t.attr('data-field'),
                            key: t.attr('data-key'),
                            index: t.attr('data-index'),
                            position: newIndex - origIndex
                        }
                    };
                    Ajax.call([request])[0].fail(Notification.exception);
                }
            });
        }
    };
});
