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
class MineField
{
    /**
     * @var array
     */
    private $dimensions = array();

    /**
     * @var array
     */
    private $resultMatrix = array();

    /**
     *
     */
    const MINE = '*';

    /**
     * @param string $input
     *
     * @return array
     */
    public function splitLinesToArray($input)
    {
        $matrix = array();
        foreach (preg_split("/\n/", $input) as $line) {
            $matrix[] = str_split($line);
        }

        $this->dimensions = array_filter(array_map('trim', $matrix[0]));
        unset($matrix[0]);

        return $matrix;
    }

    /**
     *
     */
    public function castDimensions()
    {
        foreach ($this->dimensions as &$dimension) {
            $dimension = intval($dimension);
        }
    }

    /**
     *
     */
    public function setDefaultMatrix()
    {
        $dimensions = array_values($this->dimensions);
        $rows       = $dimensions[0];
        $cols       = $dimensions[1];

        for ($i = 1; $i <= $rows; $i++) {
            $this->resultMatrix[$i] = array_fill(0, $cols, 0);
        }
    }

    /**
     * @param array $input
     *
     * @return string
     */
    public function resultMatrixToString(array $input)
    {
        $string = '';
        $size   = count($input);
        $i      = 0;
        foreach ($input as $row) {
            $i++;
            $string .= implode($row);
            $string .= $i < $size ? "\n" : '';
        }

        return $string;
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function processField($input)
    {
        $inputMatrix = $this->splitLinesToArray($input);
        $this->castDimensions();
        $this->setDefaultMatrix();

        foreach ($inputMatrix as $rowIndex => $rowData) {
            $keys = array_keys($rowData, self::MINE);
            foreach ($keys as $key) {
                $this->resultMatrix[$rowIndex][$key] = self::MINE;
                // Get left and right of mine
                isset($this->resultMatrix[$rowIndex][$key - 1]) ? $this->resultMatrix[$rowIndex][$key - 1]++ : '';
                isset($this->resultMatrix[$rowIndex][$key + 1]) ? $this->resultMatrix[$rowIndex][$key + 1]++ : '';

                // Get above left and right of mine
                isset($this->resultMatrix[$rowIndex - 1][$key - 1]) ? $this->resultMatrix[$rowIndex - 1][$key - 1]++ : '';
                isset($this->resultMatrix[$rowIndex - 1][$key + 1]) ? $this->resultMatrix[$rowIndex - 1][$key + 1]++ : '';

                // Get below left and right of mine
                isset($this->resultMatrix[$rowIndex + 1][$key - 1]) ? $this->resultMatrix[$rowIndex + 1][$key - 1]++ : '';
                isset($this->resultMatrix[$rowIndex + 1][$key + 1]) ? $this->resultMatrix[$rowIndex + 1][$key + 1]++ : '';

                // Get above and below of mine
                isset($this->resultMatrix[$rowIndex - 1][$key]) ? $this->resultMatrix[$rowIndex - 1][$key]++ : '';
                isset($this->resultMatrix[$rowIndex + 1][$key]) ? $this->resultMatrix[$rowIndex + 1][$key]++ : '';
            }
        }

        return $this->resultMatrixToString($this->resultMatrix);
    }
}
/**
 * End of file: MineField.php
 */