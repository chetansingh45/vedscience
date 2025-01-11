<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Validator;

class FeedController extends Controller
{
    public function list()
    {
        return Feed::all();
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
      
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), ['title' => 'required|string|max:255','description' => 'required|string' ]);


        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return $response['response'];
        }
    
        $feed =new  Feed();
        $feed->title = $request->title;
        $feed->description = $request->description;
        $feed->status = $request->status  ??  '0';
        $feed->save();
        
        if ($feed) {
            return response()->json([
                'response' => 'Feed created successfully',
                'success' => true,
                'feed' => $feed
            ], 201);  
        }

        return response()->json([
            'response' => 'Failed to create feed',
            'success' => false
        ], 500);  
    }

    public function show(Request $request, string $id)
    {
     $one = Feed::find($id);
     return response()->json([
        'response' => 'Feed get successfully',
        'success' => true,
        'feed' => $one
    ], 200); 
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
      //
    }
}
