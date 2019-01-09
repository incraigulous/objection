Objection
----------

Recursively wrap nested arrays in Laravel-style DTO objects and collections. Just pass in your array and **BLAMO**, you'll get a nested DTO objects and collections back. 

### Why?
I like accessing data in my views using a fluent object syntax instead of array syntax. 

##### How to use it: 


```
  $data = objection(
    [
        [
            'test' => 'asdf',
            'test2' => [
                'sub' => 'asdasdffasdf',
                'sub2' => 'teasdasdffasdfst',
            ],
        ],
        [
            'test' => 'asdasdffasdf',
            'test2' => 'teasdasdffasdfst',
        ]
    ]
  )
  
  echo $data->first()->test2->sub2; //teasdasdffasdfst
```

##### Convert it back to an array:


```
  $data->toArray();

```

##### What if I don't like using helper functions? 

```
  return \Incraigulous\Objection\ObjectionFactory::make($array);
```

## Uses

DTO Objects: https://github.com/schulzefelix/laravel-data-transfer-object <br />
Collections: https://laravel.com/docs/5.7/collections

