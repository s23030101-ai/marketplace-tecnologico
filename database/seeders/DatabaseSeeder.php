<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Inventario;
use App\Models\Categoria;     
use App\Models\Producto;      
use App\Models\Reseña;        
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear Usuario Administrador de prueba
        User::factory()->create([
            'name' => 'Admin Tec',
            'email' => 'admin@tec.edu.mx',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'is_verified_student' => true,
        ]);

        // 2. Crear Vendedores con su perfil
        $sellers = User::factory()->count(5)->create([
            'role' => 'seller',
            'is_verified_student' => true,
        ]);

        foreach ($sellers as $seller) {
            Inventario::create([
                'user_id' => $seller->id,
                'store_name' => 'Tienda de ' . $seller->name,
                'bio' => 'Vendedor de artículos escolares, snacks y accesorios.',
                'contact_phone' => '443' . rand(1000000, 9999999),
            ]);
        }

        // 3. Crear Compradores
        $buyers = User::factory()->count(10)->create([
            'role' => 'buyer',
            'is_verified_student' => true,
        ]);

        // 4. Crear Categorías
        $categoriesData = ['Material Escolar', 'Snacks y Alimentos', 'Electrónica y Gadgets', 'Ropa y Accesorios', 'Manualidades'];
        $categories = collect();

       
foreach ($categoriesData as $catName) {
    $categories->push(Categoria::create([ // 
        'name' => $catName,
        'slug' => \Illuminate\Support\Str::slug($catName),
        'description' => 'Artículos de la categoría ' . $catName,
    ]));
}

        // 5. Crear Productos asociados aleatoriamente
foreach (range(1, 25) as $i) {
    Producto::factory()->create([ // 
        'user_id' => $sellers->random()->id,
        'category_id' => $categories->random()->id, // 
    ]);
}

        // 6. Crear Reseñas de prueba
        foreach ($buyers as $buyer) {
            $product = Producto::inRandomOrder()->first();
            if ($product && $product->user_id !== $buyer->id) {
                Reseña::create([
                    'buyer_id' => $buyer->id,
                    'seller_id' => $product->user_id,
                    'product_id' => $product->id,
                    'rating' => rand(3, 5),
                    'comment' => 'Excelente producto, entrega rápida y buena atención.',
                ]);
            }
        }
    }
}
