<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $response = $this->get('/');
        $response = $this->get('/kategori/create');

        $response->assertStatus(302);
    }
}
