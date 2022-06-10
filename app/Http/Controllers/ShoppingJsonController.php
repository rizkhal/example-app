<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingRequest;
use App\Http\Resources\ShoppingResource;
use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingJsonController extends Controller
{
    public function index(Request $request)
    {
        return ShoppingResource::collection(
            Shopping::query()->paginate($request->query('perPage', 10))
        );
    }

    public function store(ShoppingRequest $request)
    {
        try {
            $shopping = Shopping::create($request->getData());

            return ShoppingResource::make($shopping);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function show(Shopping $shopping)
    {
        return ShoppingResource::make($shopping);
    }
}
