<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        $id = random_int(111111, 999999);
        parent::setUp();
        Products::factory()->create([

            'id' => $id,
            'name' => 'Set Product',
            'description' => 'A test product',
            'category' => 'pizza',
            'size' => 'medium',
            'price' => 99.99,
            'image' => 'image.jpg',
            'is_available' => true,
        ]);
    }
  
    /** @test */
    public function test_create_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'A test product',
            'category' => 'pizza',
            'size' => 'medium',
            'price' => 99.99,
            'image' => 'image.jpg',
            'is_available' => true,
        ];

        $response = $this->post(route('create.product'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_update_a_product()
    {
        $product = Products::factory()->create([
            'name' => 'Original Name',
            'size' => 'medium',
        ]);

        $updateData = [
            'name' => 'New Updated Name',
            'description' => $product->description,
            'category' => $product->category,
            'size' => $product->size,
            'price' => $product->price,
            'image' => $product->image,
            'is_available' => $product->is_available,
        ];

        $response = $this->put(route('update.product', ['id' => $product->id]), $updateData);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Updated Name', // ✅ updated value checked
        ]);
    }


    // /** @test */
    public function test_archive_a_product()
    {
        $product = Products::factory()->create();

        $response = $this->delete(route('archive.product' , ['id' => $product->id]));

        $response->assertStatus(302);

    }


    // /** @test */
    public function test_delete_a_product()
    {
        $product = Products::factory()->create();

        $response = $this->delete(route('delete.product' , ['id' => $product->id]));

        $response->assertStatus(302);

    }
}