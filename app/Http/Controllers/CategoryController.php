<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function category()
    {
      return view ('categories.category');
      // return "category";
    }
    public function addcategory(Request $request)
    {
      //$category = $request->input('category');
      //return $category;

        $this->validate($request,[
            'category'=>'required'
        ]);

        //return "validate";
       $category = new Category;
       $category->category=$request->input('category');
       $category->save();

       return redirect('/catagory')->with('response','Category added successfully');
       
       

    }

}
