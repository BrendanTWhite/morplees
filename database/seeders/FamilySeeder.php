<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Family;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
 
class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Family::factory()
            ->count(5)
            ->hasUsers(3)
            ->create();

        Family::factory()
            ->count(5)
            ->hasUsers(1)
            ->create();

        $this->command->info('Families created.');

        // Reset the details for Brendan
        $brendan = User::find(7);
        $brendan->name = 'Brendan White';
        $brendan->email = 'brendan@thespia.com';
        $brendan->password = Hash::make('dingodingo');
        $brendan->save();

        $this->command->info('Brendan created.');

    }
}
