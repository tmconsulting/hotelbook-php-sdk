PHP Hotelbook SDK
---------------

This SDK is used to connect to the hotelbook and use it methods for a 3-d party API.

* Installation 
* Get started
* Api Reference
* Contact us

### Installation
```
    composer require hotelbook/sdk
```

### Get started

First of all, you will need to have credidentals for the hotelbook. <br>
The config with credentials looks like this.

```php
    $config = [
        'url' => 'https://hotlelbook.pro/xml',
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

Everymethod returns an objects, that has to methods: 

+ getItems() 
+ getErrors()

`getItems` method returns all of the items returned from the method.
`getErros` method return all of the errors returned from hotelbook.

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

Here will be declared all the API methods and what they actually return.

### Contact us.

If you have any issues or questions regarding the API or the SDK it self, you are welcome to create an issue, or
You can write an Email to `shatilo.reymond@gmail.com` or `Maksim.Ivanov@tm-consulting.ru`