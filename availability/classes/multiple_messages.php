<?php
//

/**
 * Represents multiple availability messages.
 *
 * These are messages like 'Not available until <date>'. This class includes
 * multiple messages so that they can be rendered into a combined display, e.g.
 * using bulleted lists.
 *
 * The tree structure of this object matches that of the availability
 * restrictions.
 *
 * @package core_availability
 * @copyright 2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Represents multiple availability messages.
 *
 * These are messages like 'Not available until <date>'. This class includes
 * multiple messages so that they can be rendered into a combined display, e.g.
 * using bulleted lists.
 *
 * The tree structure of this object matches that of the availability
 * restrictions.
 *
 * @package core_availability
 * @copyright 2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_availability_multiple_messages implements renderable {
    /** @var bool True if this object represents the root of the tree */
    public $root;
    /** @var bool True if items use the AND operator (false = OR) */
    public $andoperator;
    /** @var bool True if this part of the tree is marked 'hide entirely' for non-matching users */
    public $treehidden;
    /** @var array Array of child items (may be string or this type) */
    public $items;

    /**
     * Constructor.
     *
     * @param bool $root True if this object represents the root of the tree
     * @param bool $andoperator True if items use the AND operator (false = OR)
     * @param bool $treehidden True if this part of the tree is marked 'hide entirely' for non-matching users
     * @param array $items Array of items (may be string or this type)
     */
    public function __construct($root, $andoperator, $treehidden, array $items) {
        $this->root = $root;
        $this->andoperator = $andoperator;
        $this->treehidden = $treehidden;
        $this->items = $items;
    }
}
