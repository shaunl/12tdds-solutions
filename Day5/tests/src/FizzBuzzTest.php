<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     15/01/13 - 22:36
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class FizzBuzzTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers FizzBuzz::exec()
     */
    public function exec()
    {
        $iterations = 100;

        $fizzBuzz = new FizzBuzz();
        $output = $fizzBuzz->exec($iterations);

        $expected = file_get_contents(__DIR__ . '/../datasets/fizzbuzz100.txt');

        $this->assertSame($expected, $output);
    }
}
/**
 * End of file: FizzBuzzTest.php
 */