<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     09/01/13 - 21:35
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class NumberNamesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers NumberNames::cleanNameArray()
     */
    public function cleanNameArray()
    {
        $input    = array('one', null, 'three');
        $expected = array('one', 'three');

        $numberNames = new NumberNames();
        $output      = $numberNames->cleanNameArray($input);

        $this->assertEquals(array_values($expected), array_values($output));
    }

    /**
     * @test
     * @covers NumberNames::insertConjunctions()
     */
    public function insertConjunctions()
    {
        $input = array('one', 'hundred', 'one');
        $expected = array('one', 'hundred and', 'one');

        $numberNames = new NumberNames();
        $output = $numberNames->insertConjunctions($input);

        $this->assertEquals(array_values($expected), array_values($output));
    }

    /**
     * @test
     * @covers NumberNames::fixSpecialCases()
     */
    public function fixSpecialCases()
    {
        $input = array('one', null, 'ten');
        $index = 2; // where 'ten' is.
        $expected = 'eleven';

        $numberNames = new NumberNames();
        $output = $numberNames->fixSpecialCases($input, $index);

        $this->assertSame($expected, $output);
    }

    /**
     * @test
     * @covers NumberNames::spellNumber()
     */
    public function spellNumber()
    {
        $numbers = array(
            99       => 'ninety nine',
            300      => 'three hundred',
            310      => 'three hundred and ten',
            1501     => 'one thousand, five hundred and one',
            12609    => 'twelve thousand, six hundred and nine',
            512607   => 'five hundred and twelve thousand, six hundred and seven',
            43112603 => 'forty three million, one hundred and twelve thousand, six hundred and three',
        );

        foreach ($numbers as $number => $name) {
            $numberNames  = new NumberNames();
            $computedName = $numberNames->spellNumber($number);

            $this->assertSame($name, $computedName);
            $numberNames = null;
        }
    }
}
/**
 * End of file: NumberNamesTest.php
 */