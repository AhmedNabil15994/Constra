<?php

return [
         'title'=>'Service', 
         'permissions'=>  [
       'ServiceController@index' => 'list-services', 
        'ServiceController@create' => 'add-service', 
        'ServiceController@store' => 'add-service', 
        'ServiceController@edit' => 'edit-service', 
        'ServiceController@update' => 'edit-service', 
        'ServiceController@fastEdit' => 'edit-service', 
        'ServiceController@restore' => 'restore-service', 
        'ServiceController@delete' => 'delete-service', 
        'ServiceController@destroy' => 'delete-service', 
        ], 
         ];