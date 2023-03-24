<?php

namespace Database\Seeders;

use App\Models\{User, Lapangan, Penyewaan};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::factory(3)->create();

    User::factory(1)->create([
      'username' => 'aca12345',
      'name' => 'aca',
      'email' => 'aca@ali.com',
      'role' => 2
    ]);

    User::factory(1)->create([
      'username' => 'icall_bjorka43',
      'name' => 'icall',
      'email' => 'icall@gmail.com',
      'role' => 1
    ]);

    Lapangan::factory(20)->create();
    Penyewaan::factory(20)->create();
  }
}
