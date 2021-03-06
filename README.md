# MyParcel SDK

---

- [Installation](#installation)
- [Installation without composer](#installation-without-composer)
- [Requirements](#requirements)
- [Quick start and examples](#quick-start-and-examples)
- [Available Methods](#available-methods)
- [Contribute](#contribute)

---
Please, star this repository if you use this repository. :star:

### Installation with composer

This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: [https://github.com/composer/composer](https://github.com/composer/composer)

To install the MyParcel SDK into your project, simply

	$ composer require myparcelbe/sdk
	
### Installation without composer

If you don't have experience with composer, it is possible to use the SDK without using composer.

You can download the zip on the projects [releases](https://github.com/myparcelbe/sdk/releases) page.

1. Download the package zip (SDKvx.x.x.zip).
2. Unzip the contents of the zip, and upload the vendor directory to your server.
3. In your project, require the file src/AutoLoader.php
4. You can now use the SDK in your project

### Requirements

The MyParcel SDK works on php versions 5.6, 7.x.
Also the php curl extension needs to be installed.

### Quick start and examples

```php
$myParcelCollection = new \MyParcelBE\Sdk\src\Helper\MyParcelCollection();

$consignment = (new \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository())
    ->setApiKey('api_key_from_MyParcel_backoffice')
    ->setReferenceId('Order 1203')
    ->setCountry('BE')
    ->setPerson('Piet Hier')
    ->setCompany('Piet BV')
    ->setFullStreet('Plein 1945 55b')
    ->setPostalCode('2231JE')
    ->setCity('Amsterdam')
    ->setEmail('test@test.nl');
    
$myParcelCollection
    ->addConsignment($consignment)
    ->setPdfOfLabels()
    ->downloadPdfOfLabels()
    ->setUserAgent('name_of_cms', '1.0');
```

## Available Methods
```php
$myParcelCollection = new \MyParcelBE\Sdk\src\Helper\MyParcelCollection();

$consignment = (new \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository())
    ->setApiKey('api_key_from_MyParcel_backoffice')
    ->setReferenceId('Order 1203')
    ->setCountry('BE')
    ->setPerson('Piet Hier')
    ->setCompany('Piet BV')
    ->setFullStreet('Plein 1945 55b')
    ->setPostalCode('2231JE')
    ->setPackageType(1)
    ->setCity('Amsterdam')
    ->setEmail('test@test.nl')
    ->setPhone('+31 (0)634213465')
    ->setLargeFormat(true)
    ->setOnlyRecipient(true)
    ->setSignature(true)
    ->setReturn(true)
    ->setInsurance(250)
    ->setLabelDescription('Order 10034');
    
$myParcelCollection
    ->addConsignment($consignment)
```
### User-agent
To give us insight into which CMS system you make a connection from, you should send a User-Agent. If you're using a known CMS system it's required. You must send the name of the CMS system followed by a version number. A version is not required.
```
    ->setUserAgent('name_of_cms', '1.0')
```
### Submitting full address
```
    ->setFullStreet('Plein 1945 55b')
```
### Submitting address in pieces
```php
    ->setStreet('Plein 1945')
    ->setNumber((string)55)
    ->setBoxNumber('b')
```
#### Create concept
```php
$myParcelCollection->createConcepts();
```
#### Download labels
```php
$myParcelCollection->setPdfOfLabels();
$myParcelCollection->downloadPdfOfLabels();
```
#### Get label link
```php
$myParcelCollection
    ->setLinkOfLabels()
    ->getLinkOfLabels()
```
#### MyParcel consignment id
If you don't use ```setReferenceId()```, you can also use the MyParcelConsignmentId when you create a concept:
After ```setPdfOfLabels()```, ```setLinkOfLabels()``` and ```createConcepts()```, you can save the api id to your database. With this id you can easily retrieve the latest status.
```php
$consignment->getMyParcelConsignmentId();
```
#### Get status
After ```setPdfOfLabels()```, ```setLinkOfLabels()``` and ```createConcepts()``` you can get the status.
```php
$status = $consignment->getStatus();
```
#### Get barcode
The barcode is available after ```setPdfOfLabels()``` and ```setLinkOfLabels()```
```php
$barcode = $consignment->getBarcode();
```
#### Multiple shipments
To create multiple consignments or get one pdf with multiple consignments, set multiple consignments. It's faster and cleaner.
```php
$myParcelCollection = new \MyParcelBE\Sdk\src\Helper\MyParcelCollection();

foreach ($yourShipments as $yourShipment) {

    $consignment = (new \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository())
        ->setApiKey('api_key_from_MyParcel_backoffice')
        ->setReferenceId($yourShipment->getOrderId()
        ->setName('Piet Hier');
        /** @todo; set all info */
        
    $myParcelCollection
        ->setUserAgent('name_of_cms', '1.0')
        ->addConsignment($consignment)
}
```
#### Later on
In a new request, you can get all the data again.
```php
$consignment = (new \MyParcelBE\Sdk\src\Model\Repository\MyParcelConsignmentRepository())
    ->setApiKey('api_key_from_MyParcel_backoffice')
    ->setReferenceId('Order 1203'); // or setMyParcelConsignmentId(123456)

$myParcelCollection
    ->addConsignment($consignment)
    ->setLatestData();

$consignments = $myParcelCollection
    ->getConsignments();

$firstConsignment = $consignments[0];

$status = $firstConsignment->getStatus();
$barcode = $firstConsignment->getBarcode();
```

### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.
