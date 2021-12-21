<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => 'qwerty',
            'role' => 'admin'
        ]);

        $user = User::create([
            'id' => '943adcba-f5ba-452b-80ef-fe4cbfa97bf2',
            'name' => 'seed',
            'email' => 'seed@example.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        $user->createToken('default');

        // 1|rKX9XP062XiO6DVylQ2p97QELAXJIcHsZoy3toF0
        DB::table('personal_access_tokens')
            ->update(['token' => 'bca4f59d22bd5554585474921a523ecdd74fe8169bdac75fe5d001eb2e2917d3']);


        $product = Product::create([
            'user_id' => $user->id,
            'id' => '3bcd41a4-0ab3-4225-848a-b2ab629263ec',
            'name' => 'book',
            'description' => 'The saga focuses on Geralt of Rivia and Ciri,
            who are linked by destiny. Ciri, princess of a recently conquered country
            and a pawn of international politics, becomes a witcher-in-training.
            Geralt is drawn into a whirlwind of events in his attempts to protect her.',
            'price' => 30,
            'price_currency' => 'USD'
        ]);
    }
}
