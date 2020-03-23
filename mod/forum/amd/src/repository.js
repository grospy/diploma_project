//

/**
 * Forum repository class to encapsulate all of the AJAX requests that subscribe or unsubscribe
 * can be sent for forum.
 *
 * @module     mod_forum/repository
 * @package    mod_forum
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/ajax'], function(Ajax) {
    /**
     * Set the subscription state for a discussion in a forum.
     *
     * @param {number} forumId ID of the forum the discussion belongs to
     * @param {number} discussionId ID of the discussion with the subscription state
     * @param {boolean} targetState Set the subscribed state. True == subscribed; false == unsubscribed.
     * @return {object} jQuery promise
     */
    var setDiscussionSubscriptionState = function(forumId, discussionId, targetState) {
        var request = {
            methodname: 'mod_forum_set_subscription_state',
            args: {
                forumid: forumId,
                discussionid: discussionId,
                targetstate: targetState
            }
        };
        return Ajax.call([request])[0];
    };

    var addDiscussionPost = function(postid, subject, message, messageformat, isprivatereply, topreferredformat) {
        var request = {
            methodname: 'mod_forum_add_discussion_post',
            args: {
                postid: postid,
                message: message,
                messageformat: messageformat,
                subject: subject,
                options: [{
                    name: "private",
                    value: isprivatereply,
                }, {
                    name: "topreferredformat",
                    value: topreferredformat,
                }]
            }
        };
        return Ajax.call([request])[0];
    };

    /**
     * Set the favourite state for a discussion in a forum.
     *
     * @param {number} forumId ID of the forum the discussion belongs to
     * @param {number} discussionId ID of the discussion with the subscription state
     * @param {null|date} targetState Set the favourite state. True == favourited; false == unfavourited.
     * @return {object} jQuery promise
     */
    var setFavouriteDiscussionState = function(forumId, discussionId, targetState) {
        var request = {
            methodname: 'mod_forum_toggle_favourite_state',
            args: {
                discussionid: discussionId,
                targetstate: targetState
            }
        };
        return Ajax.call([request])[0];
    };

    var setDiscussionLockState = function(forumId, discussionId, targetState) {
        var request = {
            methodname: 'mod_forum_set_lock_state',
            args: {
                forumid: forumId,
                discussionid: discussionId,
                targetstate: targetState}
        };
        return Ajax.call([request])[0];
    };

    /**
     * Set the pinned state for the discussion provided.
     *
     * @param {number} forumid
     * @param {number} discussionid
     * @param {boolean} targetstate
     * @return {*|Promise}
     */
    var setPinDiscussionState = function(forumid, discussionid, targetstate) {
        var request = {
            methodname: 'mod_forum_set_pin_state',
            args: {
                discussionid: discussionid,
                targetstate: targetstate
            }
        };
        return Ajax.call([request])[0];
    };

    /**
     * Get the discussions for the user and cmid provided.
     *
     * @param {number} userid
     * @param {number} cmid
     * @param {string} sortby
     * @param {string} sortdirection
     * @return {*|Promise}
     */
    var getDiscussionByUserID = function(userid, cmid, sortby = 'modified', sortdirection = 'DESC') {
        var request = {
            methodname: 'mod_forum_get_discussion_posts_by_userid',
            args: {
                userid: userid,
                cmid: cmid,
                sortby: sortby,
                sortdirection: sortdirection,
            },
        };
        return Ajax.call([request])[0];
    };

    /**
     * Get the posts for the discussion ID provided.
     *
     * @param {number} discussionId
     * @param {String} sortby
     * @param {String} sortdirection
     * @return {*|Promise}
     */
    var getDiscussionPosts = function(discussionId, sortby = 'created', sortdirection = 'ASC') {
        var request = {
            methodname: 'mod_forum_get_discussion_posts',
            args: {
                discussionid: discussionId,
                sortby: sortby,
                sortdirection: sortdirection,
            },
        };
        return Ajax.call([request])[0];
    };

    return {
        setDiscussionSubscriptionState: setDiscussionSubscriptionState,
        addDiscussionPost: addDiscussionPost,
        setDiscussionLockState: setDiscussionLockState,
        setFavouriteDiscussionState: setFavouriteDiscussionState,
        setPinDiscussionState: setPinDiscussionState,
        getDiscussionByUserID: getDiscussionByUserID,
        getDiscussionPosts: getDiscussionPosts,
    };
});
