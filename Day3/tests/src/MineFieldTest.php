<?php
/**
 *
 * PHP version 5.4
 *
 * @category
 * @package
 * @author      Shaun Lawless
 * @version     1.0
 * @created     14/01/13 - 21:03
 * @copyright   2013 - Shaun Lawless
 */

/**
 *
 */
class MineFieldTest extends PHPUnit_Framework_TestCase
{
    protected $mineField;

    public function setUp()
    {
        $this->mineField = new MineField();
    }

    /**
     * @test
     * @covers MineField::splitLinesToArray()
     */
    public function splitLinesToArray()
    {
        $input = "3 4\n*...\n..*.\n....";

        $expected = array(
            array('*', '.', '.', '.'),
            array('.', '.', '*', '.'),
            array('.', '.', '.', '.'),
        );

        $output = $this->mineField->splitLinesToArray($input);

        $this->assertSame(array_values($expected), array_values($output));
    }

    /**
     * @test
     * @covers MineField::castDimensions()
     */
    public function castDimensions()
    {
        $expected = array(3, 4);

        $input = "3 4\n*...\n..*.\n....";
        $this->mineField->splitLinesToArray($input);
        $this->mineField->castDimensions();

        $this->assertSame(array_values($expected), array_values($this->readAttribute($this->mineField, 'dimensions')));
    }

    /**
     * @test
     * @covers MineField::setDefaultMatrix()
     */
    public function setDefaultMatrix()
    {
        $input    = "3 4\n*...\n..*.\n....";
        $expected = array(
            array(0, 0, 0, 0),
            array(0, 0, 0, 0),
            array(0, 0, 0, 0),
        );

        $this->mineField->splitLinesToArray($input);
        $this->mineField->setDefaultMatrix();

        $this->assertSame(
            array_values($expected),
            array_values($this->readAttribute($this->mineField, 'resultMatrix'))
        );
    }

    /**
     * @test
     * @covers MineField::resultMatrixToString()
     */
    public function resultMatrixToString()
    {
        $input    = array(
            array(0, 0, 0, 0),
            array(0, 0, 0, 0),
            array(0, 0, 0, 0),
        );
        $expected = "0000\n0000\n0000";

        $string = $this->mineField->resultMatrixToString($input);

        $this->assertSame($expected, $string);
    }

    /**
     * @test
     * @covers MineField::processField()
     */
    public function processField()
    {
        $input    = "3 4\n*...\n..*.\n....";
        $expected = "*211\n12*1\n0111";

        $result = $this->mineField->processField($input);

        $this->assertSame($expected, $result);
    }
}
/**
 * End of file: MineFieldTest.php
 */