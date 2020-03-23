<?php
//

/**
 * Exported discussion builder class.
 *
 * @package    mod_forum
 * @copyright  2019 Peter Dias<peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\builders;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\discussion as discussion_entity;
use mod_forum\local\entities\forum as forum_entity;
use mod_forum\local\factories\legacy_data_mapper as legacy_data_mapper_factory;
use mod_forum\local\factories\exporter as exporter_factory;
use mod_forum\local\factories\vault as vault_factory;
use rating_manager;
use renderer_base;
use stdClass;

/**
 * Exported discussion builder class
 *
 * This class is an implementation of the builder pattern (loosely). It is responsible
 * for taking a set of related forums, discussions, and posts and generate the exported
 * version of the discussion.
 *
 * It encapsulates the complexity involved with exporting discussions. All of the relevant
 * additional resources will be loaded by this class in order to ensure the exporting
 * process can happen.
 *
 * See this doc for more information on the builder pattern:
 * https://designpatternsphp.readthedocs.io/en/latest/Creational/Builder/README.html
 *
 * @copyright  2019 Peter Dias<peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class exported_discussion {
    /** @var renderer_base $renderer Core renderer */
    private $renderer;

    /** @var legacy_data_mapper_factory $legacydatamapperfactory Data mapper factory */
    private $legacydatamapperfactory;

    /** @var exporter_factory $exporterfactory Exporter factory */
    private $exporterfactory;

    /** @var vault_factory $vaultfactory Vault factory */
    private $vaultfactory;

    /** @var rating_manager $ratingmanager Rating manager */
    private $ratingmanager;

    /**
     * Constructor.
     *
     * @param renderer_base $renderer Core renderer
     * @param legacy_data_mapper_factory $legacydatamapperfactory Legacy data mapper factory
     * @param exporter_factory $exporterfactory Exporter factory
     * @param vault_factory $vaultfactory Vault factory
     * @param rating_manager $ratingmanager Rating manager
     */
    public function __construct(
        renderer_base $renderer,
        legacy_data_mapper_factory $legacydatamapperfactory,
        exporter_factory $exporterfactory,
        vault_factory $vaultfactory,
        rating_manager $ratingmanager
    ) {
        $this->renderer = $renderer;
        $this->legacydatamapperfactory = $legacydatamapperfactory;
        $this->exporterfactory = $exporterfactory;
        $this->vaultfactory = $vaultfactory;
        $this->ratingmanager = $ratingmanager;
    }

    /**
     * Build any additional variables for the exported discussion for a given set of discussions.
     *
     * This will typically be used for a list of discussions in the same forum.
     *
     * @param stdClass $user The user to export the posts for.
     * @param forum_entity $forum The forum that each of the $discussions belong to
     * @param discussion_entity $discussion A list of all discussions that each of the $posts belong to
     * @return stdClass[] List of exported posts in the same order as the $posts array.
     */
    public function build(
        stdClass $user,
        forum_entity $forum,
        discussion_entity $discussion
    ) : array {

        $favouriteids = [];
        if ($this->is_favourited($discussion, $forum->get_context(), $user)) {
            $favouriteids[] = $discussion->get_id();
        }

        $groupsbyid = $this->get_groups_available_in_forum($forum);
        $discussionexporter = $this->exporterfactory->get_discussion_exporter(
            $user, $forum, $discussion, $groupsbyid, $favouriteids
        );

        return (array) $discussionexporter->export($this->renderer);
    }

    /**
     * Get the groups details for all groups available to the forum.
     * @param forum_entity $forum The forum entity
     * @return stdClass[]
     */
    private function get_groups_available_in_forum($forum) : array {
        $course = $forum->get_course_record();
        $coursemodule = $forum->get_course_module_record();

        return groups_get_all_groups($course->id, 0, $coursemodule->groupingid);
    }

    /**
     * Check whether the provided discussion has been favourited by the user.
     *
     * @param discussion_entity $discussion The discussion record
     * @param \context_module $forumcontext Forum context
     * @param \stdClass $user The user to check the favourite against
     *
     * @return bool Whether or not the user has favourited the discussion
     */
    public function is_favourited(discussion_entity $discussion, \context_module $forumcontext, \stdClass $user) {
        if (!isloggedin()) {
            return false;
        }

        $usercontext = \context_user::instance($user->id);
        $ufservice = \core_favourites\service_factory::get_service_for_user_context($usercontext);
        return $ufservice->favourite_exists('mod_forum', 'discussions', $discussion->get_id(), $forumcontext);
    }


}
