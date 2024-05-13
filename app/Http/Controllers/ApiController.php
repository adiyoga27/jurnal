<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function product(Request $request, $product_id) {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => Product::where('id', $product_id)->first()
        ]);
    }
}
