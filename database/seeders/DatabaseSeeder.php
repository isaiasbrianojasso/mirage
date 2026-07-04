<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@mirage.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->call([
            CategorySeeder::class,
            MirageProductsSeeder::class,
            DummyProductsSeeder::class,
            BannerSeeder::class,
            BusinessSettingSeeder::class,
            LoremIpsumSeeder::class,
            E2ECommerceSeeder::class,
        ]);
    }
}
