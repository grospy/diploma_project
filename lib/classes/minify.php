<?php
//

/**
 * JS and CSS compression.
 *
 * @package    core
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Collection of JS and CSS compression methods.
 */
class core_minify {
    /**
     * Minify JS code.
     *
     * @param string $content
     * @return string minified JS code
     */
    public static function js($content) {
        try {
            $minifier = new MatthiasMullie\Minify\JS($content);
            return $minifier->minify();
        } catch (Exception $e) {
            ob_end_clean();
            $error = $e->getMessage();
        }

        $return = <<<EOD

try {console.log('Error: Minimisation of JavaScript failed!');} catch (e) {}

// Error: $error
// Problem detected during JavaScript minimisation, please review the following code
// =================================================================================


EOD;

        return $return.$content;
    }

    /**
     * Minify JS files.
     *
     * @param array $files
     * @return string minified JS code
     */
    public static function js_files(array $files) {
        if (empty($files)) {
            return '';
        }

        $compressed = array();
        foreach ($files as $file) {
            $content = file_get_contents($file);
            if ($content === false) {
                $compressed[] = "\n\n// Cannot read JS file ".basename(dirname(dirname($file))).'/'.basename(dirname($file)).'/'.basename($file)."\n\n";
                continue;
            }
            $compressed[] = self::js($content);
        }

        return implode(";\n", $compressed);
    }

    /**
     * Minify CSS code.
     *
     * @param string $content
     * @return string minified CSS
     */
    public static function css($content) {
        $error = 'unknown';
        try {
            $minifier = new MatthiasMullie\Minify\CSS($content);
            return $minifier->minify();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = <<<EOD

/* Error: $error */
/* Problem detected during CSS minimisation, please review the following code */
/* ========================================================================== */


EOD;

        return $return.$content;
    }

    /**
     * Minify CSS files.
     *
     * @param array $files
     * @return string minified CSS code
     */
    public static function css_files(array $files) {
        if (empty($files)) {
            return '';
        }

        $compressed = array();
        foreach ($files as $file) {
            $content = file_get_contents($file);
            if ($content === false) {
                $compressed[] = "\n\n/* Cannot read CSS file ".basename(dirname(dirname($file))).'/'.basename(dirname($file)).'/'.basename($file)."*/\n\n";
                continue;
            }
            $compressed[] = self::css($content);
        }

        return implode("\n", $compressed);
    }
}
