<?php

use \App\Core\Routing\Routes;

Routes::get('/' , 'Home@index');

Routes::get('/location/{loc}' , 'Home@index');

Routes::post('/' , ['Home' , 'index']); 

Routes::post('/search' , ['Home' , 'getSearched']); 