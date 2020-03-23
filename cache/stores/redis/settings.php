<?php
//

/**
 * Redis Cache Store - Settings
 *
 * @package   cachestore_redis
 * @copyright 2013 Adam Durana
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(
    new admin_setting_configtext(
        'cachestore_redis/test_server',
        get_string('test_server', 'cachestore_redis'),
        get_string('test_server_desc', 'cachestore_redis'),
        '',
        PARAM_TEXT,
        16
    )
);
$settings->add(
    new admin_setting_configpasswordunmask(
        'cachestore_redis/test_password',
        get_string('test_password', 'cachestore_redis'),
        get_string('test_password_desc', 'cachestore_redis'),
        ''
    )
);

if (class_exists('Redis')) { // Only if Redis is available.

    $options = array(Redis::SERIALIZER_PHP => get_string('serializer_php', 'cachestore_redis'));

    if (defined('Redis::SERIALIZER_IGBINARY')) {
        $options[Redis::SERIALIZER_IGBINARY] = get_string('serializer_igbinary', 'cachestore_redis');
    }

    $settings->add(new admin_setting_configselect(
            'cachestore_redis/test_serializer',
            get_string('test_serializer', 'cachestore_redis'),
            get_string('test_serializer_desc', 'cachestore_redis'),
            Redis::SERIALIZER_PHP,
            $options
        )
    );
}
