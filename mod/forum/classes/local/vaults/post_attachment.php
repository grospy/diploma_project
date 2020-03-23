<?php
//

/**
 * Post attachment vault class.
 *
 * @package    mod_forum
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\vaults;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\post as post_entity;
use context;
use file_storage;

/**
 * Post attachment vault class.
 *
 * This should be the only place that accessed the database.
 *
 * This uses the repository pattern. See:
 * https://designpatternsphp.readthedocs.io/en/latest/More/Repository/README.html
 *
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class post_attachment {
    /** The component for attachments */
    private const COMPONENT = 'mod_forum';
    /** File area for attachments */
    private const FILE_AREA = 'attachment';
    /** Sort the attachments by filename */
    private const SORT = 'filename';
    /** Don't include directories */
    private const INCLUDE_DIRECTORIES = false;
    /** @var file_storage $filestorage File storage */
    private $filestorage;

    /**
     * Construct.
     *
     * @param file_storage $filestorage File storage
     */
    public function __construct(file_storage $filestorage) {
        $this->filestorage = $filestorage;
    }

    /**
     * Get the attachments for the given posts. The results are indexed by
     * post id.
     *
     * @param context $context The (forum) context that the posts are in
     * @param post_entity[] $posts The list of posts to load attachments for
     * @return array Post attachments indexed by post id
     */
    public function get_attachments_for_posts(context $context, array $posts) {
        $itemids = array_map(function($post) {
            return $post->get_id();
        }, $posts);

        $files = $this->filestorage->get_area_files(
            $context->id,
            self::COMPONENT,
            self::FILE_AREA,
            $itemids,
            self::SORT,
            self::INCLUDE_DIRECTORIES
        );

        $filesbyid = array_reduce($posts, function($carry, $post) {
            $carry[$post->get_id()] = [];
            return $carry;
        }, []);

        return array_reduce($files, function($carry, $file) {
            $itemid = $file->get_itemid();
            $carry[$itemid] = array_merge($carry[$itemid], [$file]);
            return $carry;
        }, $filesbyid);
    }
}
