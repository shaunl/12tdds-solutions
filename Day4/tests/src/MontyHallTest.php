<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     15/01/13 - 20:12
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class MontyHallTest extends PHPUnit_Framework_TestCase
{
    private $montyHall;

    public function setUp()
    {
        $this->montyHall = new MontyHall();
    }

    /**
     * @test
     * @covers MontyHall::setUpGame()
     */
    public function setUpGame()
    {
        $expected = array('goat', 'goat', 'car');

        $this->montyHall->setUpGame();

        $this->assertEmpty(array_diff($expected, $this->readAttribute($this->montyHall, 'doors')));
    }

    /**
     * @test
     * @covers MontyHall::makeRandomChoice()
     *
     * @depends setUpGame
     */
    public function makeRandomChoice()
    {
        $expected = 2;

        $this->montyHall->setUpGame();
        $this->montyHall->makeRandomChoice();

        $this->assertSame($expected, count($this->readAttribute($this->montyHall, 'doors')));
        $this->assertNotEmpty($this->readAttribute($this->montyHall, 'choice'));
    }

    /**
     * @test
     * @covers MontyHall::openDoorNotCar()
     *
     * @depends setUpGame
     * @depends makeRandomChoice
     */
    public function openDoorNotCar()
    {
        $expected = 1;

        $this->montyHall->setUpGame();
        $this->montyHall->makeRandomChoice();
        $opened = $this->montyHall->openDoorNotCar();

        $this->assertSame($expected, count($this->readAttribute($this->montyHall, 'doors')));
        $this->assertSame('goat', $opened);
    }

    /**
     * @test
     * @covers MontyHall::destroyGame()
     */
    public function destroyGame()
    {
        $this->assertEmpty($this->readAttribute($this->montyHall, 'doors'));
        $this->assertNull($this->readAttribute($this->montyHall, 'choice'));
    }

    /**
     * @test
     * @covers MontyHall::simulateGame()
     *
     * @depends setUpGame
     * @depends makeRandomChoice
     * @depends openDoorNotCar
     */
    public function simulateGameStick()
    {
        $iterations = 1000;
        $results    = $this->montyHall->simulateGame(true, $iterations);

        $this->assertSame($iterations, count($results));
    }

    /**
     * @test
     * @covers MontyHall::evaluateResults()
     */
    public function evaluateResultsLose()
    {
        $results  = array(
            array(
                'decision' => 'stick',
                'prize'    => 'car'
            ),
        );
        $expected = "Stick: 1 Wins: 1\nSwitch: 0 Wins: 0";

        $output = $this->montyHall->evaluateResults($results);

        $this->assertSame($expected, $output);
    }

    /**
     * @test
     * @covers MontyHall::runComparison()
     *
     * @depends destroyGame
     */
    public function runComparison()
    {
        $iterations = 1000;
        $comparison = $this->montyHall->runComparison($iterations);

        $this->assertStringMatchesFormat("Stick: 1000 Wins: %d\nSwitch: 1000 Wins: %d", $comparison);
    }
}
/**
 * End of file: MontyHallTest.php
 */