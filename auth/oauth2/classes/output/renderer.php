<?php
//

/**
 * Output rendering for the plugin.
 *
 * @package     auth_oauth2
 * @copyright   2017 Damyon Wiese
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_oauth2\output;

use plugin_renderer_base;
use html_table;
use html_table_cell;
use html_table_row;
use html_writer;
use auth\oauth2\linked_login;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

/**
 * Implements the plugin renderer
 *
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {
    /**
     * This function will render one beautiful table with all the linked_logins.
     *
     * @param \auth\oauth2\linked_login[] $linkedlogins - list of all linked logins.
     * @return string HTML to output.
     */
    public function linked_logins_table($linkedlogins) {
        global $CFG;

        $table = new html_table();
        $table->head  = [
            get_string('issuer', 'auth_oauth2'),
            get_string('info', 'auth_oauth2'),
            get_string('edit'),
        ];
        $table->attributes['class'] = 'admintable generaltable';
        $data = [];

        $index = 0;

        foreach ($linkedlogins as $linkedlogin) {
            // Issuer.
            $issuerid = $linkedlogin->get('issuerid');
            $issuer = \core\oauth2\api::get_issuer($issuerid);
            $issuercell = new html_table_cell(s($issuer->get('name')));

            // Issuer.
            $username = $linkedlogin->get('username');
            $email = $linkedlogin->get('email');
            $usernamecell = new html_table_cell(s($email) . ', (' . s($username) . ')');

            $links = '';

            // Delete.
            $deleteparams = ['linkedloginid' => $linkedlogin->get('id'), 'action' => 'delete', 'sesskey' => sesskey()];
            $deleteurl = new moodle_url('/auth/oauth2/linkedlogins.php', $deleteparams);
            $deletelink = html_writer::link($deleteurl, $this->pix_icon('t/delete', get_string('delete')));
            $links .= ' ' . $deletelink;

            $editcell = new html_table_cell($links);

            $row = new html_table_row([
                $issuercell,
                $usernamecell,
                $editcell,
            ]);

            $data[] = $row;
            $index++;
        }
        $table->data = $data;
        return html_writer::table($table);
    }
}
