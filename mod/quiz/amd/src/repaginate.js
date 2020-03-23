//

/**
 * Initialise the repaginate dialogue on quiz editing page.
 *
 * @module    mod_quiz/repaginate
 * @package   mod_quiz
 * @copyright 2019 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/modal_factory'], function($, ModalFactory) {

    var SELECTORS = {
        REPAGINATECOMMAND: '#repaginatecommand',
        HEADER: 'header',
        BODY: 'form'
    };

    /**
     * Initialise the repaginate button and add the event listener.
     */
    var init = function() {
        ModalFactory.create(
            {
                title: $(SELECTORS.REPAGINATECOMMAND).data(SELECTORS.HEADER),
                body: $(SELECTORS.REPAGINATECOMMAND).data(SELECTORS.BODY),
                large: false,
            },
            $(SELECTORS.REPAGINATECOMMAND)
        );
    };
    return {
        init: init
    };
});
