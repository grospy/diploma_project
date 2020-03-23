<?php
//

/**
 * Iterator for skipping search recordset documents that are in the future.
 *
 * @package core_search
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_search;

defined('MOODLE_INTERNAL') || die();

/**
 * Iterator for skipping search recordset documents that are in the future.
 *
 * This iterator stops iterating if it receives a document that was modified later than the
 * specified cut-off time (usually current time).
 *
 * This iterator assumes that its parent iterator returns documents in modified order (which is
 * required to be the case for search indexing). This means we will stop retrieving data from the
 * recordset
 *
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class skip_future_documents_iterator implements \Iterator {
    /** @var \Iterator Parent iterator */
    protected $parent;

    /** @var int Cutoff time; anything later than this will cause the iterator to stop */
    protected $cutoff;

    /** @var mixed Current value of iterator */
    protected $currentdoc;

    /** @var bool True if current value is available */
    protected $gotcurrent;

    /**
     * Constructor.
     *
     * @param \Iterator $parent Parent iterator, must return search documents in modified order
     * @param int $cutoff Cut-off time, default is current time
     */
    public function __construct(\Iterator $parent, $cutoff = 0) {
        $this->parent = $parent;
        if ($cutoff) {
            $this->cutoff = $cutoff;
        } else {
            $this->cutoff = time();
        }
    }

    public function current() {
        if (!$this->gotcurrent) {
            $this->currentdoc = $this->parent->current();
            $this->gotcurrent = true;
        }
        return $this->currentdoc;
    }

    public function next() {
        $this->parent->next();
        $this->gotcurrent = false;
    }

    public function key() {
        return $this->parent->key();
    }

    public function valid() {
        // Check that the parent is valid.
        if (!$this->parent->valid()) {
            return false;
        }

        if ($doc = $this->current()) {
            // This document is valid if the modification date is before the cutoff.
            return $doc->get('modified') <= $this->cutoff;
        } else {
            // If the document is false/null, allow iterator to continue.
            return true;
        }
    }

    public function rewind() {
        $this->parent->rewind();
        $this->gotcurrent = false;
    }
}
