<?php
//
/**
 * @package    backup-convert
 * @subpackage cc-library
 * @copyright  2012 Darko Miletic <dmiletic@moodlerooms.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('cc_converters.php');
require_once('cc_general.php');

class cc_converter_folder extends cc_converter {

    public function __construct(cc_i_item &$item, cc_i_manifest &$manifest, $rootpath, $path) {
        $this->defaultfile = 'folder.xml';
        parent::__construct($item, $manifest, $rootpath, $path);
    }

    public function convert($outdir) {
        $resitem = new cc_item();
        $resitem->title = $this->doc->nodeValue('/activity/folder/name');
        $this->item->add_child_item($resitem);

        $contextid = $this->doc->nodeValue('/activity/@contextid');
        cc_helpers::handle_static_content($this->manifest,
                                          $this->rootpath,
                                          $contextid,
                                          $outdir);

        return true;
    }

}

