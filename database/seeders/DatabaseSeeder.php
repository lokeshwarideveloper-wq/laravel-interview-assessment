<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $demoUser = User::firstOrNew(['email' => 'product@example.com']);

        if (! $demoUser->exists) {
            $demoUser = User::firstOrNew(['email' => 'admin@example.com']);
        }

        $demoUser->fill([
            'name' => 'Product Admin',
            'email' => 'product@example.com',
            'password' => 'product@123',
        ])->save();

        foreach (['Electronics', 'Home & Kitchen', 'Clothing', 'Books'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        foreach ([
            ['name' => 'Central Branch', 'location' => 'Downtown'],
            ['name' => 'North Branch', 'location' => 'North district'],
            ['name' => 'West Branch', 'location' => 'West district'],
        ] as $branch) {
            Branch::firstOrCreate(['name' => $branch['name']], ['location' => $branch['location']]);
        }
    }
}
