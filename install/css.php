<?php
//

/**
 * This script prints basic CSS for the installer
 *
 * @package    core
 * @subpackage install
 * @copyright  2011 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (file_exists(__DIR__.'/../config.php')) {
    // already installed
    die;
}

// and remove some of the CSS in $content.
$files = array('boost/style/moodle.css');

$content = '';

foreach($files as $file) {
    $content .= file_get_contents(__DIR__.'/../theme/'.$file) . "\n";
}

$content .= <<<EOF

body {
    padding: 4px;
}

.text-ltr {
    direction: ltr !important;
}

.headermain {
    margin: 15px;
}

h2 {
  text-align:center;
}

textarea, .uneditable-input {
    width: 50%;
}

#installdiv {
    margin-left:auto;
    margin-right:auto;
    padding: 5px;
    margin-bottom: 15px;
}

#installdiv dt {
    font-weight: bold;
}

#installdiv dd {
    padding-bottom: 0.5em;
}

.stage {
    margin-top: 2em;
    margin-bottom: 2em;
    padding: 25px;
}

#installform {
    width: 100%;
}

#envresult {
    text-align:left;
    width: auto;
    margin-left:10em;
}

#envresult dd {
    color: red;
}

fieldset {
    text-align:center;
    border:none;
}

fieldset .configphp,
fieldset .alert {
    text-align: left;
    direction: ltr;
}

.sitelink {
    text-align: center;
}

EOF;

// fix used urls
$content = str_replace('[[pix:theme|hgradient]]', '../theme/standard/pix/hgradient.jpg', $content);
$content = str_replace('[[pix:theme|vgradient]]', '../theme/standard/pix/vgradient.jpg', $content);

@header('Content-Disposition: inline; filename="css.php"');
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: post-check=0, pre-check=0', false);
@header('Pragma: no-cache');
@header('Expires: Mon, 20 Aug 1969 09:23:00 GMT');
@header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
@header('Accept-Ranges: none');
@header('Content-Type: text/css; charset=utf-8');

echo $content;
