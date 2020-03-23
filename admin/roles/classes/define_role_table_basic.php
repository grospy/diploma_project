<?php
//

/**
 * Library code used by the roles administration interfaces.
 *
 * @package    core_role
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class core_role_define_role_table_basic extends core_role_define_role_table_advanced {
    protected $stradvmessage;
    protected $strallow;

    public function __construct($context, $roleid) {
        parent::__construct($context, $roleid);
        $this->displaypermissions = array(CAP_ALLOW => $this->allpermissions[CAP_ALLOW]);
        $this->stradvmessage = get_string('useshowadvancedtochange', 'core_role');
        $this->strallow = $this->strperms[$this->allpermissions[CAP_ALLOW]];
    }

    protected function print_show_hide_advanced_button() {
        echo '<div class="advancedbutton">';
        echo '<input type="submit" class="btn btn-secondary" name="toggleadvanced"
            value="' . get_string('showadvanced', 'form') . '" />';
        echo '</div>';
    }

    protected function add_permission_cells($capability) {
        $perm = $this->permissions[$capability->name];
        $permname = $this->allpermissions[$perm];
        $defaultperm = $this->allpermissions[$this->parentpermissions[$capability->name]];
        $content = '<td class="' . $permname . '">';
        if ($perm == CAP_ALLOW || $perm == CAP_INHERIT) {
            $checked = '';
            if ($perm == CAP_ALLOW) {
                $checked = 'checked="checked" ';
            }
            $content .= '<input type="hidden" name="' . $capability->name . '" value="' . CAP_INHERIT . '" />';
            $content .= '<label><input type="checkbox" name="' . $capability->name .
                '" value="' . CAP_ALLOW . '" ' . $checked . '/> ' . $this->strallow . '</label>';
        } else {
            $content .= '<input type="hidden" name="' . $capability->name . '" value="' . $perm . '" />';
            $content .= $this->strperms[$permname] . '<span class="note">' . $this->stradvmessage . '</span>';
        }
        $content .= '</td>';
        return $content;
    }
}
