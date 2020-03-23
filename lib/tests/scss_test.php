<?php
//

/**
 * This file contains the unittests for core scss.
 *
 * @package   core
 * @category  phpunit
 * @copyright 2016 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * This file contains the unittests for core scss.
 *
 * @package   core
 * @category  phpunit
 * @copyright 2016 onwards Ankit Agarwal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_scss_testcase extends advanced_testcase {

    /**
     * Data provider for is_valid_file
     * @return array
     */
    public function is_valid_file_provider() {
        $themedirectory = core_component::get_component_directory('theme_boost');
        $realroot = realpath($themedirectory);
        return [
            "File import 1" => [
                "path" => "../test.php",
                "valid" => false
            ],
            "File import 2" => [
                "path" => "../test.py",
                "valid" => false
            ],
            "File import 3" => [
                "path" => $realroot . "/scss/moodle.scss",
                "valid" => true
            ],
            "File import 4" => [
                "path" => $realroot . "/scss/../../../config.php",
                "valid" => false
            ],
            "File import 5" => [
                "path" => "/../../../../etc/passwd",
                "valid" => false
            ],
            "File import 6" => [
                "path" => "random",
                "valid" => false
            ]
        ];
    }

    /**
     * Test cases for SassC compilation.
     */
    public function scss_compilation_provider() {
        return [
            'simple' => [
                'scss' => '$font-stack: Helvetica, sans-serif;
                           $primary-color: #333;

                           body {
                             font: 100% $font-stack;
                             color: $primary-color;
                           }',
                'expected' => <<<CSS
body {
  font: 100% Helvetica, sans-serif;
  color: #333; }

CSS
            ],
            'nested' => [
                'scss' => 'nav {
                             ul {
                               margin: 0;
                               padding: 0;
                               list-style: none;
                             }

                           li { display: inline-block; }

                           a {
                             display: block;
                             padding: 6px 12px;
                             text-decoration: none;
                           }
                         }',
                'expected' => <<<CSS
nav ul {
  margin: 0;
  padding: 0;
  list-style: none; }

nav li {
  display: inline-block; }

nav a {
  display: block;
  padding: 6px 12px;
  text-decoration: none; }

CSS
            ]
        ];
    }

    /**
     * @dataProvider is_valid_file_provider
     */
    public function test_is_valid_file($path, $valid) {
        $scss = new \core_scss();
        $pathvalid = phpunit_util::call_internal_method($scss, 'is_valid_file', [$path], \core_scss::class);
        $this->assertSame($valid, $pathvalid);
    }

    /**
     * Test that we can use the SassC compiler if it's provided.
     *
     * @dataProvider scss_compilation_provider
     * @param string $scss The raw scss to compile.
     * @param string $expectedcss The expected CSS output.
     */
    public function test_scss_compilation_with_sassc($scss, $expectedcss) {
        if (!defined('PHPUNIT_PATH_TO_SASSC')) {
            $this->markTestSkipped('Path to SassC not provided');
        }

        $this->resetAfterTest();
        set_config('pathtosassc', PHPUNIT_PATH_TO_SASSC);
        $compiler = new core_scss();
        $this->assertSame($compiler->compile($scss), $expectedcss);
    }
}
