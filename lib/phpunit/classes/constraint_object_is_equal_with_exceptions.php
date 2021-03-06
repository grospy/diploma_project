<?php
//

/**
 * Constraint that checks a simple object with an isEqual constrain, allowing for exceptions to be made for some fields.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Constraint that checks a simple object with an isEqual constrain, allowing for exceptions to be made for some fields.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class phpunit_constraint_object_is_equal_with_exceptions extends PHPUnit\Framework\Constraint\IsEqual {

    /**
     * @var array $keys The list of exceptions.
     */
    protected $keys = array();

    /**
     * @var mixed $value Need to keep it here because it became private for PHPUnit 7.x and up
     */
    protected $capturedvalue;

    /**
     * Override constructor to capture value
     */
    public function __construct($value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false,
                                bool $ignoreCase = false) {
        parent::__construct($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
        $this->capturedvalue = $value;
    }

    /**
     * Add an exception for the named key to use a different comparison
     * method. Any assertion provided by PHPUnit\Framework\Assert is
     * acceptable.
     *
     * @param string $key The key to except.
     * @param string $comparator The assertion to use.
     */
    public function add_exception($key, $comparator) {
        $this->keys[$key] = $comparator;
    }

    /**
     * Evaluates the constraint for parameter $other
     *
     * If $shouldreturnesult is set to false (the default), an exception is thrown
     * in case of a failure. null is returned otherwise.
     *
     * If $shouldreturnesult is true, the result of the evaluation is returned as
     * a boolean value instead: true in case of success, false in case of a
     * failure.
     *
     * @param  mixed    $other              Value or object to evaluate.
     * @param  string   $description        Additional information about the test
     * @param  bool     $shouldreturnesult  Whether to return a result or throw an exception
     * @return mixed
     * @throws PHPUnit\Framework\ExpectationFailedException
     */
    public function evaluate($other, $description = '', $shouldreturnesult = false) {
        foreach ($this->keys as $key => $comparison) {
            if (isset($other->$key) || isset($this->capturedvalue->$key)) {
                // One of the keys is present, therefore run the comparison.
                PHPUnit\Framework\Assert::$comparison($this->capturedvalue->$key, $other->$key);

                // Unset the keys, otherwise the standard evaluation will take place.
                unset($other->$key);
                unset($this->capturedvalue->$key);
            }
        }

        // Run the parent evaluation (isEqual).
        return parent::evaluate($other, $description, $shouldreturnesult);
    }

}
