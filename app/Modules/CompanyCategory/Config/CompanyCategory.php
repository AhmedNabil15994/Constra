<?php

return [
         'title'=>'CompanyCategory',
         'permissions'=>  [
       'CompanyCategoryController@index' => 'list-company-categories',
        'CompanyCategoryController@create' => 'add-company-category',
        'CompanyCategoryController@store' => 'add-company-category',
        'CompanyCategoryController@edit' => 'edit-company-category',
        'CompanyCategoryController@update' => 'edit-company-category',
        'CompanyCategoryController@fastEdit' => 'edit-company-category',
        'CompanyCategoryController@restore' => 'restore-company-category',
        'CompanyCategoryController@delete' => 'delete-company-category',
        'CompanyCategoryController@destroy' => 'delete-company-category',
        ], 
         ];