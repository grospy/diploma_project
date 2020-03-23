<?php
//
/**
 * Contains the favourite_repository interface.
 *
 * @package   core_favourites
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_favourites\local\repository;
use \core_favourites\local\entity\favourite;

defined('MOODLE_INTERNAL') || die();

/**
 * The favourite_repository interface, defining the basic CRUD operations for favourite type items within core_favourites.
 */
interface favourite_repository_interface {
    /**
     * Add one item to this repository.
     *
     * @param favourite $item the item to add.
     * @return favourite the item which was added.
     */
    public function add(favourite $item) : favourite;

    /**
     * Add all the items in the list to this repository.
     *
     * @param array $items the list of items to add.
     * @return array the list of items added to this repository.
     */
    public function add_all(array $items) : array;

    /**
     * Find an item in this repository based on its id.
     *
     * @param int $id the id of the item.
     * @return favourite the item.
     */
    public function find(int $id) : favourite;

    /**
     * Find all items in this repository.
     *
     * @param int $limitfrom optional pagination control for returning a subset of records, starting at this point.
     * @param int $limitnum optional pagination control for returning a subset comprising this many records.
     * @return array list of all items in this repository.
     */
    public function find_all(int $limitfrom = 0, int $limitnum = 0) : array;

    /**
     * Find all items with attributes matching certain values.
     *
     * @param array $criteria the array of attribute/value pairs.
     * @param int $limitfrom optional pagination control for returning a subset of records, starting at this point.
     * @param int $limitnum optional pagination control for returning a subset comprising this many records.
     * @return array the list of items matching the criteria.
     */
    public function find_by(array $criteria, int $limitfrom = 0, int $limitnum = 0) : array;

    /**
     * Check whether an item exists in this repository, based on its id.
     *
     * @param int $id the id to search for.
     * @return bool true if the item could be found, false otherwise.
     */
    public function exists(int $id) : bool;

    /**
     * Check whether an item exists in this repository, based on the specified criteria.
     *
     * @param array $criteria the list of key/value criteria pairs.
     * @return bool true if the favourite exists, false otherwise.
     */
    public function exists_by(array $criteria) : bool;

    /**
     * Return the total number of items in this repository.
     *
     * @return int the total number of items.
     */
    public function count() : int;

    /**
     * Return the number of favourites matching the specified criteria.
     *
     * @param array $criteria the list of key/value criteria pairs.
     * @return int the number of favourites matching the criteria.
     */
    public function count_by(array $criteria) : int;

    /**
     * Update an item within this repository.
     *
     * @param favourite $item the item to update.
     * @return favourite the updated item.
     */
    public function update(favourite $item) : favourite;

    /**
     * Delete an item by id.
     *
     * @param int $id the id of the item to delete.
     * @return void
     */
    public function delete(int $id);

    /**
     * Delete all favourites matching the specified criteria.
     *
     * @param array $criteria the list of key/value criteria pairs.
     * @return void.
     */
    public function delete_by(array $criteria);

    /**
     * Find a single favourite, based on it's unique identifiers.
     *
     * @param int $userid the id of the user to which the favourite belongs.
     * @param string $component the frankenstyle component name.
     * @param string $itemtype the type of the favourited item.
     * @param int $itemid the id of the item which was favourited (not the favourite's id).
     * @param int $contextid the contextid of the item which was favourited.
     * @return favourite the favourite.
     */
    public function find_favourite(int $userid, string $component, string $itemtype, int $itemid, int $contextid) : favourite;
}
