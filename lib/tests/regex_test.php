<?php
//

/**
 * Test PHP regex capability - this may also serve as an example for devs.
 *
 * @package   core
 * @copyright 2015 Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Petr Skoda <petr.skoda@totaralms.com>
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test PHP regex capability - this may also serve as an example for devs.
 *
 * @package   core
 * @copyright 2015 Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Petr Skoda <petr.skoda@totaralms.com>
 */
class core_regex_testcase extends advanced_testcase {
    public function test_whitespace_replacement_with_u() {
        $unicode = "Теорія і практика використання системи управління навчанням Moo
dleКиївський національний університет будівництва і архітектури, 21-22 тра
вня 2015 р.http://2015.moodlemoot.in.ua/";

        $whitespaced = preg_replace('/\s+/u', ' ', $unicode);
        $this->assertSame(str_replace("\n", ' ', $unicode), $whitespaced);
    }
}


