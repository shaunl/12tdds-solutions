<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     15/01/13 - 22:35
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class FizzBuzz
{
    public function exec($iterations)
    {
        $output = '';
        for ($i = 1; $i <= (int)$iterations; $i++) {
            $fizz = ($i %3 == 0) ? 'Fizz' : '';
            $buzz = ($i %5 == 0) ? 'Buzz' : '';

            $output .=(!empty($fizz) || !empty($buzz)) ? $fizz . $buzz: $i;
            $output .= ($i !== $iterations) ? "\r\n" : '';
        }

        return $output;
    }
}
/**
 * End of file: FizzBuzz.php
 */