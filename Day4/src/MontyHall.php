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
class MontyHall
{
    /**
     * @var array
     */
    private $doors = array();

    /**
     * @var null
     */
    private $choice = null;

    /**
     *
     */
    public function setUpGame()
    {
        $this->doors = array('goat', 'goat', 'car');
        shuffle($this->doors);
    }

    /**
     *
     */
    public function makeRandomChoice()
    {
        $choice = rand(0, 2);

        $this->choice = $this->doors[$choice];
        unset($this->doors[$choice]);
    }

    /**
     *
     */
    public function openDoorNotCar()
    {
        $goat = array_search('goat', $this->doors);

        $opened = $this->doors[$goat];
        unset($this->doors[$goat]);

        return $opened;
    }

    /**
     *
     */
    public function destroyGame()
    {
        $this->doors  = array();
        $this->choice = null;
    }

    /**
     * @param bool $decision
     * @param int  $iterations
     *
     * @return array
     */
    public function simulateGame($decision, $iterations)
    {
        $results = array();
        $key     = ($decision) ? 'stick' : 'switch';
        for ($i = 1; $i <= (int)$iterations; $i++) {
            $this->setUpGame();
            $this->makeRandomChoice();
            $this->openDoorNotCar();

            $prize = ($decision) ? $this->choice : $this->doors;

            $results[] = array(
                'decision' => $key,
                'prize'    => $prize,
            );

            $this->destroyGame();
        }

        return $results;
    }

    /**
     * @param array $results
     *
     * @return string
     */
    public function evaluateResults(array $results)
    {
        $wins = array(
            'stick'  => 0,
            'switch' => 0,
        );

        $stick = $switch = 0;

        foreach ($results as $result) {
            $result['decision'] == 'stick' ? $stick++ : $switch++;
            $result['prize'] === 'car' ? $wins[$result['decision']]++ : '';
        }

        $evaluation = 'Stick: '.$stick.' Wins: '.$wins['stick'];
        $evaluation .= "\nSwitch: ".$switch.' Wins: '.$wins['switch'];

        return $evaluation;
    }

    /**
     * @param int $iterations
     *
     * @return string
     */
    public function runComparison($iterations)
    {
        $results = $this->simulateGame(true, $iterations);
        $this->destroyGame();
        $resultsSwitch = $this->simulateGame(false, $iterations);

        foreach ($resultsSwitch as $result) {
            array_push($results, $result);
        }

        return $this->evaluateResults($results);
    }
}
/**
 * End of file: MontyHall.php
 */