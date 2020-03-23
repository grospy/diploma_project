<?php
//
/**
 * Capabilities for the Recently accessed items block.
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
$capabilities = array(
        'block/recentlyaccesseditems:myaddinstance' => array(
                'captype' => 'write',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes' => array(
                        'user' => CAP_ALLOW
                ),
                'clonepermissionsfrom' => 'moodle/my:manageblocks'
        )
);