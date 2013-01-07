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
    public function minValue($input)
    {
        return min($input);
    }

    public function maxValue($input)
    {
        return max($input);
    }

    public function countElements($input)
    {
        return count($input);
    }

    public function average($input)
    {
        return $this->sum($input) / $this->countElements($input);
    }

    private function sum($input)
    {
        return array_sum($input);
    }
}
/**
 * End of file: Stats.php
 */