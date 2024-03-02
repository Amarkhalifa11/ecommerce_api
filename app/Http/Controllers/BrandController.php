<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{

    public function all_brand()
    {
        $brands = Brand::paginate(10);
        return response()->json($brands, 200);
    }

    // public function show($id)
    // {
    //     $brand = Brand::where('id' , $id)->get();
    //     return response()->json($brand, 200);

    // }

    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return response()->json($brand, 200);
        }else{
            return response()->json('the brand is not found' , 401);
        }

    }

    public function store(StoreBrandRequest $request)
    {
        $name = $request->name;
        $brand = Brand::create([
            'name' => $name,
        ]);

        return response()->json('the brand is added successfully' , 200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request,$id)
    {
        $name = $request->name;
        $brand = Brand::find($id);
        $brand->update([
            'name' => $name,
        ]);

        return response()->json('the brand is updated successfully' . 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->delete();
            return response()->json('the brand is deleted successfully' . 200);
        }else{
            return response()->json('the brand is not found' . 401);
        }


    }
}
