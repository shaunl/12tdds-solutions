<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     07/01/13 - 21:52
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class Stats
{
    /**
     * @param array $input
     *
     * @return int
     */
    public function minValue($input)
    {
        return min($input);
    }

    /**
     * @param array $input
     *
     * @return int
     */
    public function maxValue($input)
    {
        return max($input);
    }

    /**
     * @param array $input
     *
     * @return int
     */
    public function countElements($input)
    {
        return count($input);
    }

    /**
     * @param array $input
     *
     * @return float
     */
    public function average($input)
    {
        return $this->sum($input) / $this->countElements($input);
    }

    /**
     * @param array $input
     *
     * @return int
     */
    private function sum($input)
    {
        return array_sum($input);
    }
}
/**
 * End of file: Stats.php
 */