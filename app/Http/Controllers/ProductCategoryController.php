<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        try {
            $querryData = ProductCategory::all();
            $formattedDatas = new ProductCategoryCollection($querryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /** 
     * Store a newly created resource in storage. 
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $querryData = ProductCategory::create($validatedRequest);
            $formattedDatas = new ProductCategoryResource($querryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /** 
     * Display the specified resource. 
     */
    public function show(string $id)
    {
        try {
            $querryData = ProductCategory::findOrFail($id);
            $formattedDatas = new ProductCategoryResource($querryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /** 
     * Update the specified resource in storage. 
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $querryData = ProductCategory::findOrFail($id);
            $querryData->update($validatedRequest);
            $querryData->save();
            $formattedDatas = new ProductCategoryResource($querryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /** 
     * Remove the specified resource from storage. 
     */
    public function destroy(string $id)
    {
        try {
            $querryData = ProductCategory::findOrFail($id);
            $querryData->delete();
            $formattedDatas = new ProductCategoryResource($querryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
