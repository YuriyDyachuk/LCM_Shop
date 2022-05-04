<?php

namespace Database\Seeders;

use App\Models\Adminer;
use Illuminate\Database\Seeder;

class AdminerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adminer::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$T59YIrTGaj0S8AycwD1FDusuLUZC5hdt/wLoXojFp4vnYpnx2p1Ma',
        ]);
    }
}
