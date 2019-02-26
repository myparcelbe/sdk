<?php

/**
 * For Dutch consignments the street should be divided into name, number and addition. This code tests whether the
 * street is split properly.
 *
 * If you want to add improvements, please create a fork in our GitHub:
 * https://github.com/myparcelbe
 *
 * @author      Reindert Vetter <info@sendmyparcel.be>
 * @copyright   2010-2017 MyParcel
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US  CC BY-NC-ND 3.0 NL
 * @link        https://github.com/myparcelbe/sdk
 * @since       File available since Release v0.1.0
 */

namespace MyParcelBE\Sdk\tests\CreateConsignments\SplitStreetTest;
use MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository;


/**
 * Class SplitStreetTest
 * @package MyParcelBE\Sdk\tests\SplitStreetTest
 */
class SplitStreetTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository::setFullStreet
     * @dataProvider additionProvider()
     */
    public function testSplitStreet($fullStreetTest, $fullStreet, $street, $number, $boxNumber)
    {
        $consignment = (new MyParcelConsignmentRepository())
            ->setCountry('BE')
            ->setFullStreet($fullStreetTest);

        $this->assertEquals($fullStreet, $consignment->getFullStreet(), 'Full street: ' . $fullStreetTest);
        $this->assertEquals($street, $consignment->getStreet(), 'Street: ' . $fullStreetTest);
        $this->assertEquals($number, $consignment->getNumber(), 'Number from: ' . $fullStreetTest);
        $this->assertEquals($boxNumber, $consignment->getBoxNumber(), 'Box number from: ' . $fullStreetTest);
    }

    /**
     * Data for the test
     *
     * @return array
     */
    public function additionProvider()
    {
        return [
            [
                'full_street_test' => 'Zennestraat 32 bte 20',
                'full_street' => 'Zennestraat 32 bus 20',
                'street' => 'Zennestraat',
                'number' => '32',
                'box_number' => '20',
            ],
            [
                'full_street_test' => 'Zennestraat 32 bus 20',
                'full_street' => 'Zennestraat 32 bus 20',
                'street' => 'Zennestraat',
                'number' => '32',
                'box_number' => '20',
            ],
            [
                'full_street_test' => 'Zennestraat 32 box 32',
                'full_street' => 'Zennestraat 32 bus 32',
                'street' => 'Zennestraat',
                'number' => '32',
                'box_number' => '32',
            ],
            [
                'full_street_test' => 'Zennestraat 32 boîte 20',
                'full_street' => 'Zennestraat 32 bus 20',
                'street' => 'Zennestraat',
                'number' => '32',
                'box_number' => '20',
            ],
            [
                'full_street_test' => 'Dendermondestraat 55 Bus 12',
                'full_street' => 'Dendermondestraat 55 bus 12',
                'street' => 'Dendermondestraat',
                'number' => '55',
                'box_number' => '12',
            ],
            [
                'full_street_test' => 'Steengroefstraat 21-27',
                'full_street' => 'Steengroefstraat 21-27',
                'street' => 'Steengroefstraat',
                'number' => '21-27',
                'box_number' => '',
            ],
            [
                'full_street_test' => 'Philippe de Champagnestraat 23',
                'full_street' => 'Philippe de Champagnestraat 23',
                'street' => 'Philippe de Champagnestraat',
                'number' => '23',
                'box_number' => '',
            ],
            [
                'full_street_test' => 'Kortenberglaan 4-10',
                'full_street' => 'Kortenberglaan 4-10',
                'street' => 'Kortenberglaan',
                'number' => '4-10',
                'box_number' => '',
            ],
        ];
    }
}