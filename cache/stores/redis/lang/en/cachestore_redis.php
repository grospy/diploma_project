<?php
//

/**
 * Redis Cache Store - English language strings
 *
 * @package   cachestore_redis
 * @copyright 2013 Adam Durana
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['compressor_none'] = 'No compression.';
$string['compressor_php_gzip'] = 'Use gzip compression.';
$string['compressor_php_zstd'] = 'Use Zstandard compression.';
$string['pluginname'] = 'Redis';
$string['prefix'] = 'Key prefix';
$string['prefix_help'] = 'This prefix is used for all key names on the Redis server.
* If you only have one Moodle instance using this server, you can leave this value default.
* Due to key length restrictions, a maximum of 5 characters is permitted.';
$string['prefixinvalid'] = 'Invalid prefix. You can only use a-z A-Z 0-9-_.';
$string['privacy:metadata:redis'] = 'The Redis cachestore plugin stores data briefly as part of its caching functionality. This data is stored on an Redis server where data is regularly removed.';
$string['privacy:metadata:redis:data'] = 'The various data stored in the cache';
$string['serializer_igbinary'] = 'The igbinary serializer.';
$string['serializer_php'] = 'The default PHP serializer.';
$string['server'] = 'Server';
$string['server_help'] = 'This sets the hostname or IP address of the Redis server to use.';
$string['password'] = 'Password';
$string['password_help'] = 'This sets the password of the Redis server.';
$string['test_server'] = 'Test server';
$string['test_server_desc'] = 'Redis server to use for testing.';
$string['test_password'] = 'Test server password';
$string['test_password_desc'] = 'Redis test server password.';
$string['test_serializer'] = 'Serializer';
$string['test_serializer_desc'] = 'Serializer to use for testing.';
$string['useserializer'] = 'Use serializer';
$string['useserializer_help'] = 'Specifies the serializer to use for serializing.
The valid serializers are Redis::SERIALIZER_PHP or Redis::SERIALIZER_IGBINARY.
The latter is supported only when phpredis is configured with --enable-redis-igbinary option and the igbinary extension is loaded.';
$string['usecompressor'] = 'Use compressor';
$string['usecompressor_help'] = 'Specifies the compressor to use after serializing. It is done at Moodle Cache API level, not at php-redis level.';