<?php
//


/**
 * Moodleform for the user interface for managing external blog links.
 *
 * @package    moodlecore
 * @subpackage blog
 * @copyright  2009 Nicolas Connault
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    // It must be included from a Moodle page.
}

require_once($CFG->libdir.'/formslib.php');

class blog_edit_external_form extends moodleform {
    public function definition() {
        global $CFG;

        $mform =& $this->_form;

        $mform->addElement('url', 'url', get_string('url', 'blog'), array('size' => 60), array('usefilepicker' => false));
        $mform->setType('url', PARAM_URL);
        $mform->addRule('url', get_string('emptyurl', 'blog'), 'required', null, 'client');
        $mform->addHelpButton('url', 'url', 'blog');

        $mform->addElement('text', 'name', get_string('name', 'blog'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addHelpButton('name', 'name', 'blog');

        $mform->addElement('textarea', 'description', get_string('description', 'blog'), array('cols' => 50, 'rows' => 7));
        $mform->addHelpButton('description', 'description', 'blog');

        // To filter external blogs by their tags we do not need to check if tags in moodle are enabled.
        $mform->addElement('text', 'filtertags', get_string('filtertags', 'blog'), array('size' => 50));
        $mform->setType('filtertags', PARAM_TAGLIST);
        $mform->addHelpButton('filtertags', 'filtertags', 'blog');

        $mform->addElement('tags', 'autotags', get_string('autotags', 'blog'),
                array('itemtype' => 'blog_external', 'component' => 'core'));
        $mform->addHelpButton('autotags', 'autotags', 'blog');

        $this->add_action_buttons();

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', 0);

        $mform->addElement('hidden', 'returnurl');
        $mform->setType('returnurl', PARAM_URL);
        $mform->setDefault('returnurl', 0);
    }

    /**
     * Additional validation includes checking URL and tags
     */
    public function validation($data, $files) {
        global $CFG;

        $errors = parent::validation($data, $files);

        require_once($CFG->libdir . '/simplepie/moodle_simplepie.php');

        $rss = new moodle_simplepie();
        $rssfile = $rss->registry->create('File', array($data['url']));
        $filetest = $rss->registry->create('Locator', array($rssfile));

        if (!$filetest->is_feed($rssfile)) {
            $errors['url'] = get_string('feedisinvalid', 'blog');
        } else {
            $rss->set_feed_url($data['url']);
            if (!$rss->init()) {
                $errors['url'] = get_string('emptyrssfeed', 'blog');
            }
        }

        return $errors;
    }

    public function definition_after_data() {
        global $CFG, $COURSE;
        $mform =& $this->_form;

        $name = trim($mform->getElementValue('name'));
        $description = trim($mform->getElementValue('description'));
        $url = $mform->getElementValue('url');

        if (empty($name) || empty($description)) {
            $rss = new moodle_simplepie($url);

            if (empty($name) && $rss->get_title()) {
                $mform->setDefault('name', $rss->get_title());
            }

            if (empty($description) && $rss->get_description()) {
                $mform->setDefault('description', $rss->get_description());
            }
        }

        if ($id = $mform->getElementValue('id')) {
            $mform->freeze('url');
            if ($mform->elementExists('filtertags')) {
                $mform->freeze('filtertags');
            }
            // TODO change the filtertags element to a multiple select, using the tags of the external blog
            // Use $rss->get_channel_tags().
        }
    }
}
