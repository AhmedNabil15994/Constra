<?php

return [
         'title'=>'Company', 
         'permissions'=>  [
       'CompanyController@index' => 'list-companies', 
        'CompanyController@create' => 'add-company', 
        'CompanyController@store' => 'add-company', 
        'CompanyController@edit' => 'edit-company', 
        'CompanyController@update' => 'edit-company', 
        'CompanyController@fastEdit' => 'edit-company', 
        'CompanyController@restore' => 'restore-company', 
        'CompanyController@delete' => 'delete-company', 
        'CompanyController@destroy' => 'delete-company', 
        ], 
         ];