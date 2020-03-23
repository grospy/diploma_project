<?php
//
/**
 * @package    backup-convert
 * @subpackage cc-library
 * @copyright  2012 Darko Miletic <dmiletic@moodlerooms.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once 'cc_converters.php';
require_once 'cc_general.php';

class cc_converter_label extends cc_converter {

    public function __construct(cc_i_item &$item, cc_i_manifest &$manifest, $rootpath, $path){
        $this->defaultfile = 'label.xml';
        parent::__construct($item, $manifest, $rootpath, $path);
    }

    public function convert($outdir) {
        $resitem = new cc_item();
        $resitem->title = $this->doc->nodeValue('/activity/label/name');
        $this->item->add_child_item($resitem);
        return true;
    }
}