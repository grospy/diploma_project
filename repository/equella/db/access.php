<?php
//

/**
 * Capabilities for equella repository.
 *
 * @package    repository_equella
 * @copyright  2012 Dongsheng Cai {@link http://dongsheng.org}
 * @author     Dongsheng Cai <dongsheng@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'repository/equella:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    )
);
