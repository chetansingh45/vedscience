<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function store(Request $request){

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

    public function list() {
        return Category::with('books')->get();
    }

    public function destroy(Request $request)
    {
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), ['id' => 'required']);
        
        if ($validator->fails()) {
          $response['response'] = $validator->messages();
        } else {
            $category = Category::find($request->id);
            if($category->delete()){
                $response['response'] = 'category deleted successfully';
                $response['success'] = true;
            }
        }
        
        return $response;
    }

    public function show($id) {
        return Category::with('books')->first();
    }
}
