<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class Dataawal extends Seeder
{
    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';  
        $user->email = 'adminkasir@gamil.com';
        $user->password = bcrypt('admin123');
        $user->role = 'admin';
        $user->save();
    }
}
