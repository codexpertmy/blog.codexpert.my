<?php

use App\Category;

if (!function_exists('get_category_items')) {

    function get_category_items()
    {
        return Category::all();
    }
}
