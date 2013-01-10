<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     09/01/13 - 21:44
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class NumberNames
{
    /**
     * @var array
     */
    protected $singles = array(
        null,
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
    );

    /**
     * @var array
     */
    protected $specialCases = array(
        1  => 'hundred',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
    );

    /**
     * @var array
     */
    protected $multiples = array(
        0 => null,
        1 => 'ten',
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety',
    );

    /**
     * @var array
     */
    protected $powersOfTen = array(
        0  => null,
        1  => null, // omitted as it's coverd by multiples
        2  => 'hundred',
        3  => 'thousand,',
        6  => 'million',
        9  => 'billion',
        12 => 'trillion',
        15 => 'quadrillion',
        18 => 'quintillion',
        24 => 'septillion',
        27 => 'octillion',
        30 => 'nonillion',
        33 => 'decillion',
        36 => 'undecillion',
        39 => 'duodecillion',
        42 => 'tredecillion',
        45 => 'quattuordecillion',
        48 => 'quindecillion',
        51 => 'sexdecillion',
        54 => 'septendecillion',
        57 => 'octodecillion',
        60 => 'novemdecillion',
        63 => 'vigintillion',
    );

    /**
     * @var array
     */
    protected $pronunciationPattern = array(
        's',
        'm',
        's',
    );

    /**
     * @param int $number
     *
     * @return string
     */
    public function spellNumber($number)
    {
        $names = array_reverse(str_split($number));
        $names = $this->getDigitNames($names);
        $names = $this->cleanNameArray($names);
        $names = $this->insertConjunctions($names);

        return implode(' ', array_reverse($names));
    }

    /**
     * @param array $names
     *
     * @return array
     */
    public function cleanNameArray(array $names)
    {
        foreach ($names as $key => $name) {
            if ($name === null) {
                unset($names[$key]);
            }
        }

        return $names;
    }

    /**
     * @param array $names
     *
     * @return array
     */
    public function insertConjunctions(array $names)
    {
        foreach ($names as &$name) {
            $name = ($name === 'hundred' && count($names) > 2) ? 'hundred and' : $name;
        }

        return $names;
    }

    /**
     * @param array $names
     * @param int   $index
     *
     * @return array mixed
     */
    public function fixSpecialCases($names, $index)
    {
        $prevDigit = $names[$index - 2] != null ? array_search($names[$index - 2], $this->singles) : 0;

        return $this->specialCases[10 + $prevDigit];
    }

    private function getDigitNames($names)
    {
        $length = count($names);
        $name = array();
        $i    = 0;

        foreach ($names as $digit) {
            $name[] = array_key_exists($i, $this->powersOfTen) ? $this->powersOfTen[$i] : null;
            $i++;
            $pattern = array_shift($this->pronunciationPattern);

            // first is always single
            switch ($pattern) {
                case 's':
                    $name[] = $this->singles[$digit];
                    break;
                case 'm':
                    $name[] = $this->multiples[$digit];
                    $index  = count($name) - 1;
                    if ($name[$index] == 'ten') {
                        $name[$index]     = $this->fixSpecialCases($name, $index);
                        $name[$index - 2] = null;
                    }
            }

            array_push($this->pronunciationPattern, $pattern);
        }

        return $name;
    }
}
/**
 * End of file: NumberNames.php
 */