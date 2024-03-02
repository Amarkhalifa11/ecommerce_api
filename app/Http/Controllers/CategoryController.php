<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function all_category()
    {
        $category = Category::paginate(10);
        return response()->json($category, 200);
    }

    // public function show($id)
    // {
    //     $brand = Brand::where('id' , $id)->get();
    //     return response()->json($brand, 200);

    // }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json($category, 200);
        }else{
            return response()->json( 'the category is not found' , 401);
        }

    }

    public function store(StoreCategoryRequest $request)
    {
        $name = $request->name;
        $brand_image = $request->file('image'); 
 
        $name_gen = hexdec(uniqid()); 
        $img_ext = strtolower($brand_image->getClientOriginalExtension()); 
        $img_name = $name_gen . '.' . $img_ext; 
         
        $upload_location = 'frontend/img/category/'; 
        $image = $img_name; 
        $brand_image->move($upload_location,$img_name); 

        $category = Category::create([
            'name' => $name,
            'image' => $image,
        ]);

        return response()->json( 'the category is added successfully' , 200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,$id)
    {
        $category = Category::find($id);
        $brand_image = $request->file('image'); 
 
        $name_gen = hexdec(uniqid()); 
        $img_ext = strtolower($brand_image->getClientOriginalExtension()); 
        $img_name = $name_gen . '.' . $img_ext; 
         
        $upload_location = 'frontend/img/category/'; 
        $image = $img_name; 
        $brand_image->move($upload_location,$img_name); 


        $category->update([
            'name' => $name,   
            'image' => $image,

        ]);

        return response()->json('the category is updated successfully' . 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        if ($category) {
            return response()->json('the category is deleted successfully' . 200);
        }else{
            return response()->json('the category is not found' . 200);
        }


    }
}
