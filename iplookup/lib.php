<?php

//

/**
 * IP Lookup utility functions
 *
 * @package    core
 * @subpackage iplookup
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Returns location information
 * @param string $ip
 * @return array
 */
function iplookup_find_location($ip) {
    global $CFG;

    $info = array('city'=>null, 'country'=>null, 'longitude'=>null, 'latitude'=>null, 'error'=>null, 'note'=>'',  'title'=>array());

    if (!empty($CFG->geoip2file) and file_exists($CFG->geoip2file)) {
        $reader = new GeoIp2\Database\Reader($CFG->geoip2file);
        $record = $reader->city($ip);

        if (empty($record)) {
            $info['error'] = get_string('iplookupfailed', 'error', $ip);
            return $info;
        }

        $info['city'] = core_text::convert($record->city->name, 'iso-8859-1', 'utf-8');
        $info['title'][] = $info['city'];

        $countrycode = $record->country->isoCode;
        $countries = get_string_manager()->get_list_of_countries(true);
        if (isset($countries[$countrycode])) {
            // Prefer our localized country names.
            $info['country'] = $countries[$countrycode];
        } else {
            $info['country'] = $record->country->names['en'];
        }
        $info['title'][] = $info['country'];

        $info['longitude'] = $record->location->longitude;
        $info['latitude']  = $record->location->latitude;
        $info['note'] = get_string('iplookupmaxmindnote', 'admin');

        return $info;

    } else {
        require_once($CFG->libdir.'/filelib.php');

        if (strpos($ip, ':') !== false) {
            // IPv6 is not supported by geoplugin.net.
            $info['error'] = get_string('invalidipformat', 'error');
            return $info;
        }

        $ipdata = download_file_content('http://www.geoplugin.net/json.gp?ip='.$ip);
        if ($ipdata) {
            $ipdata = preg_replace('/^geoPlugin\((.*)\)\s*$/s', '$1', $ipdata);
            $ipdata = json_decode($ipdata, true);
        }
        if (!is_array($ipdata)) {
            $info['error'] = get_string('cannotgeoplugin', 'error');
            return $info;
        }
        $info['latitude']  = (float)$ipdata['geoplugin_latitude'];
        $info['longitude'] = (float)$ipdata['geoplugin_longitude'];
        $info['city']      = s($ipdata['geoplugin_city']);

        $countrycode = $ipdata['geoplugin_countryCode'];
        $countries = get_string_manager()->get_list_of_countries(true);
        if (isset($countries[$countrycode])) {
            // prefer our localized country names
            $info['country'] = $countries[$countrycode];
        } else {
            $info['country'] = s($ipdata['geoplugin_countryName']);
        }

        $info['note'] = get_string('iplookupgeoplugin', 'admin');

        $info['title'][] = $info['city'];
        $info['title'][] = $info['country'];

        return $info;
    }

}
