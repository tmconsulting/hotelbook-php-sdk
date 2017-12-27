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
        'login' => 'YOUR LOGIN',
        'password' => 'YOUR PASSSWORD'
    ];
```

(if yoy pass anything not valid, it throws an exception while creating the main instance)

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

Now the result will be an instance of ResultProceeder with all of the results

#### Handling errors and Proceeding results.

If method has an error, it throws an exception that you can handle and than run getErrors the result. 

```php
    try {
        $result = $main->book(...someArguments);    
    } catch (Exception $e)
    {
        //Do something with the exception
    }
```

Every method returns an object (if it doesn't throw an exception), that has to methods: 

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

#### Meta Explanation

All static data API $methods are available through `$main->{$YOUR_METHOD_NAME}`. <br>
It gives an object with results (items, errors). (Described above.)

#### Available method

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
* Resort - (Fetch all available Resorts)
* HotelType - (Fetch all available Hotel Types)
* HotelCategory - (Fetch all available Hotel Categories)
* HotelFacility - (Fetch all available Hotel Facilities)
* HotelList- (Fetch all available Hotel Lists)
* Meal - (Fetch all available Meal Types)
* MealBreakfast - (Fetch all available Meal Breakfast Types)
* RoomSize - (Fetch all available Room Sizes)
* RoomType - (Fetch all available Room Types)
* RoomAmenity - (Fetch all available Room Amenities)
* RoomView - (Fetch all available Room Views)
* CurrencyRate - (Fetch currancy rates)

##### Fetch Countries

###### Meta-explanation

Fetch countries method is used to fetch all of the countries exist in the hotelbook database.
So you can use it as a search parameter, etc...

###### Basic example

```php
    //You already have an instance of SDK, and it's stored in $main
    $countries = $main->country();
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
    $cities = $main->city();
    $citiesArray = $cities->getItems();
```

Fetch all cities by country.

```php
    //Get first country item from the DB.
    $country = current($main->country()->getItems());
    //Find all cities there.
    $cities = $main->city($country);
    //Get all available items.
    $citiesArray = $cities->getItems();
```

### Contact us.

If you have any issues or questions regarding the API or the SDK it self, you are welcome to create an issue, or
You can write an Email to `shatilo.reymond@gmail.com` or `roquie0@gmail.com`