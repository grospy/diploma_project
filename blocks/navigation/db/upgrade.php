<?php
//

/**
 * This file keeps track of upgrades to the navigation block
 *
 * Sometimes, changes between versions involve alterations to database structures
 * and other major things that may break installations.
 *
 * The upgrade function in this file will attempt to perform all the necessary
 * actions to upgrade your older installation to the current version.
 *
 * If there's something it cannot do itself, it will tell you what you need to do.
 *
 * The commands in here will all be database-neutral, using the methods of
 * database_manager class
 *
 * Please do not forget to use upgrade_set_timeout()
 * before any action that may take longer time to finish.
 *
 * @since Moodle 2.0
 * @package block_navigation
 * @copyright 2009 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * As of the implementation of this block and the general navigation code
 * in Moodle 2.0 the body of immediate upgrade work for this block and
 * settings is done in core upgrade {@see lib/db/upgrade.php}
 *
 * There were several reasons that they were put there and not here, both becuase
 * the process for the two blocks was very similar and because the upgrade process
 * was complex due to us wanting to remvoe the outmoded blocks that this
 * block was going to replace.
 *
 * @param int $oldversion
 * @param object $block
 */
function xmldb_block_navigation_upgrade($oldversion, $block) {
    global $CFG;

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
