<?php

/**
 * Create one concept
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

namespace MyParcelBE\Sdk\tests\SendConsignments\SendOneConsignmentTest;

use MyParcelBE\Sdk\src\Helper\MyParcelCollection;
use MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository;


/**
 * Class SendPickupFromCheckoutDataTest
 * @package MyParcelBE\Sdk\tests\SendOneConsignmentTest
 */
class SendPickupFromCheckoutDataTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test one shipment with createConcepts()
     */
    public function testSendOneConsignment()
    {
        if (getenv('API_KEY') == null) {
            echo "\033[31m Set MyParcel API-key in 'Environment variables' before running UnitTest. Example: API_KEY=f8912fb260639db3b1ceaef2730a4b0643ff0c31. PhpStorm example: http://take.ms/sgpgU5\n\033[0m";
            return $this;
        }

        foreach ($this->additionProvider() as $consignmentTest) {

            $myParcelCollection = new MyParcelCollection();
            $consignment = (new MyParcelConsignmentRepository())
                ->setApiKey($consignmentTest['api_key'])
                ->setCountry($consignmentTest['cc'])
                ->setPerson($consignmentTest['person'])
                ->setCompany($consignmentTest['company'])
                ->setFullStreet($consignmentTest['full_street_test'])
                ->setPostalCode($consignmentTest['postal_code'])
                ->setCity($consignmentTest['city'])
                ->setEmail('reindert@myparcel.nl')
                ->setPhone($consignmentTest['phone']);

            if (key_exists('checkout_data', $consignmentTest)) {
                $consignment->setPickupAddressFromCheckout($consignmentTest['checkout_data']);
            }

//            if (key_exists('delivery_date', $consignmentTest)) {
//                $consignment->setDeliveryDate($consignmentTest['delivery_date']);
//            }

            if (key_exists('delivery_type', $consignmentTest)) {
                $consignment->setDeliveryType($consignmentTest['delivery_type']);
            }

            if (key_exists('package_type', $consignmentTest)) {
                $consignment->setPackageType($consignmentTest['package_type']);
            }

            if (key_exists('large_format', $consignmentTest)) {
                $consignment->setLargeFormat($consignmentTest['large_format']);
            }

            if (key_exists('only_recipient', $consignmentTest)) {
                $consignment->setOnlyRecipient($consignmentTest['only_recipient']);
            }

            if (key_exists('signature', $consignmentTest)) {
                $consignment->setSignature($consignmentTest['signature']);
            }

            if (key_exists('return', $consignmentTest)) {
                $consignment->setReturn($consignmentTest['return']);
            }

            if (key_exists('insurance', $consignmentTest)) {
                $consignment->setInsurance($consignmentTest['insurance']);
            }

            if (key_exists('label_description', $consignmentTest)) {
                $consignment->setLabelDescription($consignmentTest['label_description']);
            }

            if (key_exists('pickup_postal_code', $consignmentTest)) {
                $consignment->setPickupPostalCode($consignmentTest['pickup_postal_code']);
            }

            if (key_exists('pickup_street', $consignmentTest)) {
                $consignment->setPickupStreet($consignmentTest['pickup_street']);
            }

            if (key_exists('pickup_city', $consignmentTest)) {
                $consignment->setPickupCity($consignmentTest['pickup_city']);
            }

            if (key_exists('pickup_number', $consignmentTest)) {
                $consignment->setPickupNumber($consignmentTest['pickup_number']);
            }

            if (key_exists('pickup_location_code', $consignmentTest)) {
                $consignment->setPickupLocationCode($consignmentTest['pickup_location_code']);
            }

            if (key_exists('pickup_location_name', $consignmentTest)) {
                $consignment->setPickupLocationName($consignmentTest['pickup_location_name']);
            }

            $myParcelCollection->addConsignment($consignment);

            /**
             * Create concept
             */
            $myParcelCollection->createConcepts()->setLatestData();

            $this->assertEquals(true, $consignment->getMyParcelConsignmentId() > 1, 'No id found');
            $this->assertEquals($consignmentTest['api_key'], $consignment->getApiKey(), 'getApiKey()');
            $this->assertEquals($consignmentTest['cc'], $consignment->getCountry(), 'getCountry()');
            $this->assertEquals($consignmentTest['person'], $consignment->getPerson(), 'getPerson()');
            $this->assertEquals($consignmentTest['company'], $consignment->getCompany(), 'getCompany()');
            $this->assertEquals($consignmentTest['full_street'], $consignment->getFullStreet(), 'getFullStreet()');
            $this->assertEquals($consignmentTest['number'], $consignment->getNumber(), 'getNumber()');
            $this->assertEquals($consignmentTest['box_number'], $consignment->getBoxNumber(), 'getBoxNumber()');
            $this->assertEquals($consignmentTest['postal_code'], $consignment->getPostalCode(), 'getPostalCode()');
            $this->assertEquals($consignmentTest['city'], $consignment->getCity(), 'getCity()');
            $this->assertEquals($consignmentTest['phone'], $consignment->getPhone(), 'getPhone()');

            if (key_exists('package_type', $consignmentTest)) {
                $this->assertEquals($consignmentTest['package_type'], $consignment->getPackageType(), 'getPackageType()');
            }

            if (key_exists('large_format', $consignmentTest)) {
                $this->assertEquals($consignmentTest['large_format'], $consignment->isLargeFormat(), 'isLargeFormat()');
            }

            if (key_exists('only_recipient', $consignmentTest)) {
                $this->assertEquals($consignmentTest['only_recipient'], $consignment->isOnlyRecipient(), 'isOnlyRecipient()');
            }

            if (key_exists('signature', $consignmentTest)) {
                $this->assertEquals($consignmentTest['signature'], $consignment->isSignature(), 'isSignature()');
            }

            if (key_exists('return', $consignmentTest)) {
                $this->assertEquals($consignmentTest['return'], $consignment->isReturn(), 'isReturn()');
            }

            if (key_exists('label_description', $consignmentTest)) {
                $this->assertEquals($consignmentTest['label_description'], $consignment->getLabelDescription(), 'getLabelDescription()');
            }

            if (key_exists('insurance', $consignmentTest)) {
                $this->assertEquals($consignmentTest['insurance'], $consignment->getInsurance(), 'getInsurance()');
            }

            if (key_exists('delivery_type', $consignmentTest)) {
                $this->assertEquals($consignmentTest['delivery_type'], $consignment->getDeliveryType(), 'getDeliveryType()');
            }

//            if (!empty($consignmentTest['delivery_date'])) {
//                $this->assertEquals($consignmentTest['delivery_date'], $consignment->getDeliveryDate(), 'getDeliveryDate()');
//            }

            if (!empty($consignmentTest['pickup_postal_code'])) {
                $this->assertEquals($consignmentTest['pickup_postal_code'], $consignment->getPickupPostalCode(), 'getPickupPostalCode()');
            }

            if (!empty($consignmentTest['pickup_street'])) {
                $this->assertEquals($consignmentTest['pickup_street'], $consignment->getPickupStreet(), 'getPickupStreet()');
            }

            if (!empty($consignmentTest['pickup_city'])) {
                $this->assertEquals($consignmentTest['pickup_city'], $consignment->getPickupCity(), 'getPickupCity()');
            }

            if (!empty($consignmentTest['pickup_number'])) {
                $this->assertEquals($consignmentTest['pickup_number'], $consignment->getPickupNumber(), 'getPickupNumber()');
            }

            if (!empty($consignmentTest['pickup_location_code'])) {
                $this->assertEquals($consignmentTest['pickup_location_code'], $consignment->getPickupLocationCode(), 'getPickupLocationCode()');
            }

            if (!empty($consignmentTest['pickup_location_name'])) {
                $this->assertEquals($consignmentTest['pickup_location_name'], $consignment->getPickupLocationName(), 'getPickupLocationName()');
            }

            /**
             * Get label
             */
            $myParcelCollection
                ->setLinkOfLabels();

            $this->assertEquals(true, preg_match("#^https://api.myparcel.nl/pdfs#", $myParcelCollection->getLinkOfLabels()), 'Can\'t get link of PDF');

            echo "\033[32mGenerated pickup label from checkout label: \033[0m";
            print_r($myParcelCollection->getLinkOfLabels());
            echo "\n\033[0m";

            /** @var MyParcelConsignmentRepository $consignment */
            $consignment = $myParcelCollection->getOneConsignment();
            $this->assertEquals(true, preg_match("#^3SMYPA#", $consignment->getBarcode()), 'Barcode is not set');

            /** @todo; clear consignment in MyParcelCollection */
        }
    }

    /**
     * Data for the test
     *
     * @return array
     */
    public function additionProvider()
    {

        $datetime = new \DateTime();
        $datetime->modify('+1 day');
//        $delivery_date = $datetime->format('Y\-m\-d\ h:i:s');

        return [
            [
                'api_key' => getenv('API_KEY'),
                'cc' => 'BE',
                'person' => 'Piet',
                'company' => 'Mega Store',
                'full_street_test' => 'Koestraat 55',
                'full_street' => 'Koestraat 55',
                'street' => 'Koestraat',
                'number' => 55,
                'box_number' => '',
                'postal_code' => '2231JE',
                'city' => 'Katwijk',
                'phone' => '123-45-235-435',
                'package_type' => 1,
                'label_description' => 'Label description',
                'checkout_data' => '{"date":"2019-05-31","time":[{"start":"16:00:00","type":4,"price":{"amount":0,"currency":"EUR"}}],"location":"The Read Shop","street":"Anjelierenstraat","number":"43","postal_code":"2231GT","city":"Rijnsburg","start_time":"16:00:00","price":0,"price_comment":"retail","comment":"Dit is een Postkantoor. Post en pakketten die u op werkdagen vóór de lichtingstijd afgeeft, bezorgen we binnen Nederland de volgende dag.","phone_number":"071-4023063","opening_hours":{"monday":["08:00-18:00"],"tuesday":["08:00-18:00"],"wednesday":["08:00-18:00"],"thursday":["08:00-18:00"],"friday":["08:00-19:00"],"saturday":["08:00-18:00"],"sunday":[]},"distance":"253","location_code":"163463","options":{"signature":false,"only_recipient":false}}',
            ],
            [
                'api_key' => getenv('API_KEY'),
                'cc' => 'BE',
                'person' => 'Piet',
                'company' => 'Mega Store',
                'full_street_test' => 'Koestraat 55',
                'full_street' => 'Koestraat 55',
                'street' => 'Koestraat',
                'number' => 55,
                'box_number' => '',
                'postal_code' => '2231JE',
                'city' => 'Katwijk',
                'phone' => '123-45-235-435',
                'package_type' => 1,
                'delivery_type' => 5,
//                'delivery_date' => $delivery_date,
                'label_description' => 'Label description',
                'pickup_postal_code' => '2222AB',
                'pickup_street' => 'Scheepmakerstraat',
                'pickup_city' => 'Katwijk',
                'pickup_number' => '63',
                'pickup_location_name' => 'KantoorExpert Katwijk',
            ]
        ];
    }
}