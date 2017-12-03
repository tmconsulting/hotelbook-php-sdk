PHP Hotelbook SDK
---------------

This SDK is used to connect to the hotelbook and use it methods for a 3-d party API.

* [Installation](#installation)
* [Get started](#get-started)
* [Api Reference](#api-reference)
* [Contact us](#contact-us)

### Installation
```
    composer require hotelbook/sdk
```

### Get started

First of all, you will need to have credentials for the hotelbook. <br>
The config with credentials looks like this.

```php
    $config = [
        'url' => 'https://hotelbook.pro/xml',
        'auth' => [
            'login' => 'YOUR LOGIN',
            'password' => 'YOUR PASSSWORD'
        ]
    ];
```

After that, include the library and create an basic instance of it. 

```php
    //Require vendor
    require __DIR__ . "/../vendor/autoload.php";

    //Use main hotelbook class
    use App\Hotelbook\Main;
    
    //Create an instance of main class 
    $hotelbook = new Main($config);
```

Now you can use all the methods of the hotelbook sdk.
For example: 

E.g search for hotels:

```php

use Carbon\Carbon;

$from = Carbon::parse('08-07-2018');
$till = Carbon::parse('09-07-2018');

$result = $hotelbook->search(1, $from, $till, [new SearchPassenger(1, [2])]);

```

Now the result will be an instance of SearchResult

#### Handling errors and Proceeding results.

Every method returns an objects, that has to methods: 

+ getItems() 
+ getErrors()

`getItems` method returns all of the items returned from the method.
`getErrors` method return all of the errors returned from hotelbook.

So that you can do something like: 

```php
    //$result is a result of search request
      
   if (!empty($result->getErrors()) {
     //Handle error
   } 
   
   $items = $result->getItems();
   //Do something with items.
```  

### API Reference

To use any of methods, you have to create an instance of HotelBook SDK. 
Described [here](#get-started) 

Currently available methods:

* Search (Search for hotels)
* Async Search (Search for hotels in Asynchronous mode )
* Detail (Hotel Details)
* Book Order (Book a Hotel)
* Cancel Order (Cancel booking)
* Confirm Order (Confirm booking )
* Annulate Order (Cancel booking after confirm)

And methods to fetch dictionaries.

* [Country](#fetch-countries) - (Fetch all available countries)
* [City](#fetch-cities) - (Fetch all available Cities)
* Location - (Fetch all available Locations)
* HotelType - (Fetch all available Hotel Types)
* Meal - (Fetch all available Meal Types)
* Room Size - (Fetch all available Room Sizes)
* Room Type - (Fetch all available Room Types)
* Room Amenity - (Fetch all available Room Amenities)

#### Dictionary API Reference

All static Data API $methods are available through `$main->getDictionary()->{$YOUR_METHOD_NAME}`. <br>
It gives an object with results (items, errors). (Described above.)

All the items have it public methods to access the data in them. 

E.g 
```php
    $item->getId()
    $item->getName()
    //.....etc
```

##### Fetch Countries

###### Meta-explanation

Fetch countries method is used to fetch all of the countries exist in the hotelbook database.
So you can use it as a search parameter, etc...

###### Basic example

```php
    //You already have an instance of SDK, and it's stored in $main
    $countries = $main->getDictionary()->country();
    //Now, in countries, you have a simple result.
    $countiesArray = $countries->getItems();
    //Now in $countiesArray you have an array of Countries.
```

##### Fetch Cities

###### Meta-explanation

Fetch cities is used to make search more deeper, so you can use it as a search parameter.
Also, you can search cities by a country (So you fetch all the cities in a country.)

###### Basic examples

Fetch all cities exist in the Database.

```php
    $cities = $main->getDictionary()->city();
    $citiesArray = $cities->getItems();
```

Fetch all cities by country.

```php
    //Get first country item from the DB.
    $country = current($main->getDictionary()->country()->getItems());
    //Find all cities there.
    $cities = $main->getDictionary()->city($country);
    //Get all available items.
    $citiesArray = $cities->getItems();
```

### Contact us.

If you have any issues or questions regarding the API or the SDK it self, you are welcome to create an issue, or
You can write an Email to `shatilo.reymond@gmail.com` or `roquie0@gmail.com`