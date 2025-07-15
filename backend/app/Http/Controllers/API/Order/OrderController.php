<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Application\Order\OrderHandler;

class OrderController extends Controller
{

    public function __construct(private OrderHandler $orderHandler)
    {
        $this->orderHandler = $orderHandler;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Correct validation
        $Validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $Validator->errors()
            ]);
        }

        $user_order = User::where('uId', $request->user_id)->first();

        if ($user_order) {
            // Correct order creation
            // $order = Orders::create([
            //     'user_id' => $request->user_id,
            //     'name' => $request->name,
            //     'phone_number' => $request->phone_number,
            //     'address' => $request->address,
            //     'total_price' => $request->total_price,
            //     'status' => 'pending',
            //     'payment_method' => $request->payment_method,
            // ]);

            $order = $this->orderHandler->create(
                $request->user_id,
                $request->name,
                $request->phone_number,
                $request->address,
                $request->total_price,
                'pending',
                $request->payment_method,
            );

            return response()->json([
                'status' => true,
                'message' => 'Order Successfully Created',
                'data' => $order
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'User Not Found'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
