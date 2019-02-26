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
class SplitLongStreetTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository::setFullStreet
     * @dataProvider additionProvider()
     */
    public function testSplitStreet($country, $fullStreetTest, $street, $streetAdditionalInfo)
    {
        $consignment = (new MyParcelConsignmentRepository())
            ->setCountry($country)
            ->setFullStreet($fullStreetTest);

        $this->assertEquals(
            $street,
            $consignment->getFullStreet(true),
            'Street: ' . $street
        );

        $this->assertEquals(
            $streetAdditionalInfo,
            $consignment->getStreetAdditionalInfo(),
            'Street additional info: ' . $streetAdditionalInfo
        );
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
                'NZ',
                'full_street_test' => 'Ir. Mr. Dr. van Waterschoot van der Grachtstraat in Heerlen 14 t',
                'street' => 'Ir. Mr. Dr. van Waterschoot van der',
                'street_additional_info' => 'Grachtstraat in Heerlen 14 t',
            ],
            [
                'NZ',
                'full_street_test' => 'Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu',
                'street' => 'Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu',
                'street_additional_info' => '',
            ],
            [
                'NZ',
                'full_street_test' => 'testtienpp testtienpp',
                'street' => 'testtienpp testtienpp',
                'street_additional_info' => '',
            ],
            [
                'NZ',
                'full_street_test' => 'Wethouder Fierman Eduard Meerburg senior kade 14 t',
                'street' => 'Wethouder Fierman Eduard Meerburg senior',
                'street_additional_info' => 'kade 14 t',
            ],
            [
                'NZ',
                'full_street_test' => 'Ir. Mr. Dr. van Waterschoot van der Grachtstraat 14 t',
                'street' => 'Ir. Mr. Dr. van Waterschoot van der',
                'street_additional_info' => 'Grachtstraat 14 t',
            ],
            [
                'NZ',
                'full_street_test' => 'Koestraat 554 t',
                'street' => 'Koestraat 554 t',
                'street_additional_info' => '',
            ],
        ];
    }
}