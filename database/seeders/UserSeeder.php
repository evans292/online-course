<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Headmaster;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('otakugamer'),
        ]);

        Admin::create([
            'user_id' => $admin->id,
            'name' => $admin->name
        ]);

        // $student = User::create([
        //     'name' => 'Student',
        //     'role_id' => 2,
        //     'email' => 'student@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Student::create([
        //     'nis' => '12345',
        //     'schoolclass_id' => null,
        //     'user_id' => $student->id,
        //     'name' => $student->name
        // ]);

        // $student2 = User::create([
        //     'name' => 'Student 2',
        //     'role_id' => 2,
        //     'email' => 'student2@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Student::create([
        //     'nis' => '34521',
        //     'schoolclass_id' => null,
        //     'user_id' => $student2->id,
        //     'name' => $student2->name
        // ]);

        // $student3 = User::create([
        //     'name' => 'Student 3',
        //     'role_id' => 2,
        //     'email' => 'student3@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Student::create([
        //     'nis' => '54321',
        //     'schoolclass_id' => null,
        //     'user_id' => $student3->id,
        //     'name' => $student3->name
        // ]);

        // $teacher = User::create([
        //     'name' => 'Teacher',
        //     'role_id' => 3,
        //     'email' => 'teacher@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Teacher::create([
        //     'nip' => '291202',
        //     'user_id' => $teacher->id,
        //     'name' => $teacher->name
        // ]);

        // $teacher2 = User::create([
        //     'name' => 'Teacher 2',
        //     'role_id' => 3,
        //     'email' => 'teacher2@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Teacher::create([
        //     'nip' => '030602',
        //     'user_id' => $teacher2->id,
        //     'name' => $teacher2->name
        // ]);

        // $headmaster = User::create([
        //     'name' => 'Headmaster',
        //     'role_id' => 4,
        //     'email' => 'headmaster@example.com',
        //     'password' => Hash::make('otakugamer'),
        // ]);

        // Teacher::create([
        //     'nip' => '123456',
        //     'user_id' => $headmaster->id,
        //     'name' => $headmaster->name
        // ]);
    }
}
