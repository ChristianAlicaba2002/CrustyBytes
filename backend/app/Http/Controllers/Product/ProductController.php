<?php

namespace App\Http\Controllers\Product;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Application\Product\ProductHandler;
use App\Models\ArchiveItems;

class ProductController extends Controller
{
    public function __construct(private ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    // Create a new product
    public function create(Request $request)
    {
        $data = Validator::make(array_map('trim', $request->all()), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|in:pizza,drink,dessert',
            'size' => 'required|string|in:small,medium,large',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]);

        if (!$data->fails()) {
            return redirect()->route('admin.dashboard')->with('error', $data->errors());
        }

        $data = [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        do {
            $product_id = random_int(100000, 999999);
        } while (Products::where('id', $product_id)->exists());

        $this->productHandler->createProduct(
            $product_id,
            $request->name,
            $request->description,
            $request->category,
            $request->size,
            $request->price,
            $data['image'] ?? null,
            $request->is_available ? true : false
        );

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = Products::where('id', $id)->first();

        if (!$item) {
            return redirect()->route('admin.dashboard')->with('error', 'Product not found.');
        }

        $data = Validator::make(array_map('trim', $request->all()), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|in:pizza,drink,dessert',
            'size' => 'required|string|in:small,medium,large',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]);

        if (!$data->fails()) {
            return redirect()->route('admin.dashboard')->with('error', $data->errors());
        }

        $data = [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->productHandler->updateProduct(
            $item->id,
            $request->name,
            $request->description,
            $request->category,
            $request->size,
            $request->price,
            $data['image'] ?? $item->image,
            $request->is_available ? true : false
        );

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }
    
    public function delete($id)
    {
        $item = Products::where('id', $id)->first();

        if (!$item) {
            return redirect()->route('admin.dashboard')->with('error', 'Product not found.');
        }

        $this->productHandler->deleteProduct($id);

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }

    public function archive($id)
    {
        $item = Products::where('id', $id)->first();

        if (!$item) {
            return redirect()->route('admin.dashboard')->with('error', 'Product not found.');
        }

        $this->productHandler->archiveProduct($id);

        return redirect()->route('admin.dashboard')->with('success', 'Product archived successfully.');
    }
}
