<?php
//
/**
 * @package    backup-convert
 * @subpackage cc-library
 * @copyright  2011 Darko Miletic <dmiletic@moodlerooms.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('cc_converters.php');
require_once('cc_general.php');

class cc_converter_resource extends cc_converter {

    public function __construct(cc_i_item &$item, cc_i_manifest &$manifest, $rootpath, $path) {
        $this->cc_type     = cc_version11::webcontent;
        $this->defaultfile = 'resource.xml';
        parent::__construct($item, $manifest, $rootpath, $path);
    }

    public function convert($outdir) {
        $title = $this->doc->nodeValue('/activity/resource/name');
        $contextid = $this->doc->nodeValue('/activity/@contextid');
        $files = cc_helpers::handle_resource_content($this->manifest,
                                                   $this->rootpath,
                                                   $contextid,
                                                   $outdir);
        $deps = null;
        $resvalue = null;
        foreach ($files as $values) {
            if ($values[2]) {
                $resvalue = $values[0];
                break;
            }
        }

        $resitem = new cc_item();
        $resitem->identifierref = $resvalue;
        $resitem->title = $title;
        $this->item->add_child_item($resitem);

        // Checking the visibility.
        $this->manifest->update_instructoronly($resvalue, !$this->is_visible());

        return true;
    }

}

