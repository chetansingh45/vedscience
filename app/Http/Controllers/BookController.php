<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::with('category')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), ['cat_id' => 'required','name' => 'required','book' => 'required|mimes:pdf']);
        
        if ($validator->fails()) {
          $response['response'] = $validator->messages();
        } else {
            $book = new Book();
            $book->name = $request->name;
            $file = $request->file('book');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->move(public_path('books'), $name);
            $book->book = $name;
            $book->cat_id = $request->cat_id;
            $book->save();
            if($book->id){
                $response['response'] = 'book created successfully';
                $response['success'] = true;
            }
        }
        
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::with('category')->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), ['id' => 'required']);
        
        if ($validator->fails()) {
          $response['response'] = $validator->messages();
        } else {
            $book = Book::find($request->id);
            if($book->delete()){
                $response['response'] = 'book deleted successfully';
                $response['success'] = true;
            }
        }
        
        return $response;
    }
}
