//

/**
 * Sets the equal height to the user plan widget boxes.
 *
 * @module      mod_workshop/workshopview
 * @category    output
 * @copyright   Loc Nguyen <loc.nguyendinh@harveynash.vn>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {

    /**
     * Sets the equal height to all elements in the group.
     *
     * @param {jQuery} group List of nodes.
     */
    function equalHeight(group) {
        var tallest = 0;
        group.height('auto');
        group.each(function() {
            var thisHeight = $(this).height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }

    return /** @alias module:mod_workshop/workshopview */ {
        init: function() {
            var $dt = $('.path-mod-workshop .userplan dt');
            var $dd = $('.path-mod-workshop .userplan dd');
            equalHeight($dt);
            equalHeight($dd);
            $(window).on("resize", function() {
                equalHeight($dt);
                equalHeight($dd);
            });
        }
    };
});
