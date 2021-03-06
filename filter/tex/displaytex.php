<?php
//

/**
 * This script displays tex source code, it is used also from the algebra filter.
 *
 * @package    filter
 * @subpackage tex
 * @copyright  2004 Zbigniew Fiedorowicz fiedorow@math.ohio-state.edu
 *             Originally based on code provided by Bruno Vernier bruno@vsbeducation.ca
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


define('NO_MOODLE_COOKIES', true); // Because it interferes with caching

require('../../config.php');

if (!filter_is_enabled('tex') and !filter_is_enabled('algebra')) {
    print_error('filternotenabled');
}

$texexp = optional_param('texexp', '', PARAM_RAW);

$title = get_string('source', 'filter_tex')

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <div>
      <dl>
      <dt><?php echo $title; ?>:</dt>
        <dd><?php p($texexp); ?></dd>
      </dl>
    </div>
  </body>
</html>
