<?php
//

/**
 * Contexts initializer class
 *
 * @package    core
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use Behat\Behat\Context\BehatContext,
    Behat\MinkExtension\Context\MinkContext,
    Moodle\BehatExtension\Context\MoodleContext;

/**
 * Loads main subcontexts
 *
 * Loading of moodle subcontexts is done by the Moodle extension
 *
 * Renamed from behat FeatureContext class according
 * to Moodle coding styles conventions
 *
 * @package    core
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_init_context extends BehatContext {

    /**
     * Initializes subcontexts
     *
     * @param  array $parameters context parameters (set them up through behat.yml)
     * @return void
     */
    public function __construct(array $parameters) {
        $this->useContext('moodle', new MoodleContext($parameters));
    }

}
