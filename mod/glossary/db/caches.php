<?php
//

/**
 * Glossary cache definitions.
 *
 * @package    mod_glossary
 * @category   cache
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$definitions = array(
    // This MUST NOT be a local cache, sorry cluster lovers.
    'concepts' => array(
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => true, // The course id or 0 for global.
        'simpledata' => false,
        'staticacceleration' => true,
        'staticaccelerationsize' => 30,
    ),
);
