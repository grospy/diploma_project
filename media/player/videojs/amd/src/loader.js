//

/**
 * Video JS loader.
 *
 * This takes care of applying the filter on content which was dynamically loaded.
 *
 * @package    media_videojs
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/event'], function($, Event) {

    /**
     * Stores the method we need to execute on the first load of videojs module.
     */
    var onload;

    /**
     * Set-up.
     *
     * Adds the listener for the event to then notify video.js.
     * @param {Function} executeonload function to execute when media_videojs/video is loaded
     */
    var setUp = function(executeonload) {
        onload = executeonload;
        // Notify Video.js about the nodes already present on the page.
        notifyVideoJS(null, $('body'));
        // We need to call popover automatically if nodes are added to the page later.
        Event.getLegacyEvents().done(function(events) {
            $(document).on(events.FILTER_CONTENT_UPDATED, notifyVideoJS);
        });
    };

    /**
     * Notify video.js of new nodes.
     *
     * @param {Event} e The event.
     * @param {NodeList} nodes List of new nodes.
     */
    var notifyVideoJS = function(e, nodes) {
        var selector = '.mediaplugin_videojs';

        // Find the descendants matching the expected parent of the audio and video
        // tags. Then also addBack the nodes matching the same selector. Finally,
        // we find the audio and video tags contained in those parents. Kind thanks
        // to jQuery for the simplicity.
        nodes.find(selector)
            .addBack(selector)
            .find('audio, video').each(function() {
                var id = $(this).attr('id'),
                    config = $(this).data('setup-lazy'),
                    modules = ['media_videojs/video-lazy'];

                if (config.techOrder && config.techOrder.indexOf('youtube') !== -1) {
                    // Add YouTube to the list of modules we require.
                    modules.push('media_videojs/Youtube-lazy');
                }
                if (config.techOrder && config.techOrder.indexOf('flash') !== -1) {
                    // Add Flash to the list of modules we require.
                    modules.push('media_videojs/videojs-flash-lazy');
                }
                require(modules, function(videojs) {
                    if (onload) {
                        onload(videojs);
                        onload = null;
                    }
                    videojs(id, config);
                });
            });
    };

    return {
        setUp: setUp
    };

});
