<?php

return [
         'title'=>'Order', 
         'permissions'=>  [
       'OrderController@index' => 'list-orders', 
        'OrderController@create' => 'add-order', 
        'OrderController@store' => 'add-order', 
        'OrderController@edit' => 'edit-order', 
        'OrderController@update' => 'edit-order', 
        'OrderController@fastEdit' => 'edit-order', 
        'OrderController@restore' => 'restore-order', 
        'OrderController@delete' => 'delete-order', 
        'OrderController@destroy' => 'delete-order', 
        ], 
         ];