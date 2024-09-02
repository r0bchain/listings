<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function update(Request $request, $id)
    {

      
        $category = Category::find($id);
        $category->name = $request->cover_image;
        $category->save();

        return response()->json([
            'message' => 'Image updated successful'
        ], 200); // 200 is the HTTP status code for OK
    }

}