<?php
/**
 * For Dutch consignments the street should be divided into name, number and addition. For shipments to other
 * the address countries should be on one line. For this it is required first fill out a country. This code tests
 * whether the street has remained the same after the request.
 *
 * If you want to add improvements, please create a fork in our GitHub:
 * https://github.com/myparcelbe
 *
 * @author      Reindert Vetter <reindert@myparcel.nl>
 * @copyright   2010-2017 MyParcel
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US  CC BY-NC-ND 3.0 NL
 * @link        https://github.com/myparcelbe/sdk
 * @since       File available since Release v0.1.0
 */

namespace MyParcelBE\Sdk\tests\CreateConsignments\InternationalFullStreetTest;

use MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository;


/**
 * Class InternationalFullStreetTest
 *
 * @package MyParcelBE\Sdk\tests\InternationalFullStreetTest
 */
class InternationalFullStreetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository::getFullStreet
     * @dataProvider additionProvider()
     */
    public function testSplitStreet($cc, $fullStreet)
    {
        $consignment = (new MyParcelConsignmentRepository())
            ->setCountry($cc)
            ->setFullStreet($fullStreet);

        $this->assertEquals($fullStreet, $consignment->getFullStreet(), 'Full street: ' . $fullStreet);
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
                'cc' => 'FR',
                'full_street' => 'No. 7 street',
            ],
        ];
    }
}