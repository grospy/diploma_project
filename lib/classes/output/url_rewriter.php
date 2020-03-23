<?php
//

/**
 * URL rewriter base.
 *
 * @package    core
 * @author     Brendan Heywood <brendan@catalyst-au.net>
 * @copyright  Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * URL rewriter interface
 *
 * @package    core
 * @author     Brendan Heywood <brendan@catalyst-au.net>
 * @copyright  Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface url_rewriter {

    /**
     * Rewrite moodle_urls into another form.
     *
     * @param moodle_url $url a url to potentially rewrite
     * @return moodle_url Returns a new, or the original, moodle_url;
     */
    public static function url_rewrite(\moodle_url $url);

    /**
     * Gives a url rewriting plugin a chance to rewrite the current page url
     * avoiding redirects and improving performance.
     *
     * @return void
     */
    public static function html_head_setup();


}

