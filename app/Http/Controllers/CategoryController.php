<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function create(Request $request){

        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), ['name' => 'required']);
        
        if ($validator->fails()) {
          $response['response'] = $validator->messages();
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            if($category->id){
                $response['response'] = 'category created successfully';
                $response['success'] = true;
            }
        }
        
        return $response;
    }
}
