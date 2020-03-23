<?php
//

/**
 * The settings for the APCu store.
 *
 * This file is part of the APCu cache store, it contains the API for interacting with an instance of the store.
 *
 * @package    cachestore_apcu
 * @copyright  2014 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$settings->add(
    new admin_setting_configcheckbox(
        'cachestore_apcu/testperformance',
        new lang_string('testperformance', 'cachestore_apcu'),
        new lang_string('testperformance_desc', 'cachestore_apcu'),
        false
    )
);
