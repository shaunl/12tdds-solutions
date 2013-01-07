<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     07/01/13 - 21:53
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class StatsTest extends PHPUnit_Framework_TestCase
{
    public $testInput = array(6, 9, 15, -2, 92, 11);

    public $stats;

    public function setUp()
    {
        $this->stats = new Stats();
    }

    /**
     * @test
     * @covers Stats::minValue()
     */
    public function minValue()
    {
        $output = $this->stats->minValue($this->testInput);

        $this->assertSame(min($this->testInput), $output);
    }

    /**
     * @test
     * @covers Stats::maxValue()
     */
    public function maxValue()
    {
        $output = $this->stats->maxValue($this->testInput);

        $this->assertSame(max($this->testInput), $output);
    }

    /**
     * @test
     * @covers Stats::countElements()
     */
    public function countElements()
    {
        $output = $this->stats->countElements($this->testInput);

        $this->assertSame(count($this->testInput), $output);
    }

    /**
     * @test
     * @covers Stats::average()
     */
    public function average()
    {
        $output  = $this->stats->average($this->testInput);
        $average = array_sum($this->testInput) / count($this->testInput);

        $this->assertSame($average, $output);
    }
}
/**
 * End of file: StatsTest.php
 */