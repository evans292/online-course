<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Schoolclass;
use App\Models\Subjectmatter;
use Illuminate\Database\Seeder;

class SchoolclassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schoolclass::create([
            'teacher_id' => 1,
            'name' => 'X RPL 1',
            'information' => 'Kelas 10 jurusan rpl batch 1'
        ]);

        Schoolclass::create([
            'teacher_id' => null,
            'name' => 'X RPL 2',
            'information' => 'Kelas 10 jurusan rpl batch 2'
        ]);

        Course::create([
            'name' => 'DG X RPL',
            'information' => 'Pelajaran dg kelas x rpl'
        ]);

        Course::create([
            'name' => 'PD X RPL',
            'information' => 'Pelajaran pd kelas x rpl'
        ]);

        Subjectmatter::create([
            'course_id' => 2,
            'title' => 'Algoritma dasar',
            'path' => 'public/file'
        ]);

        Subjectmatter::create([
            'course_id' => 1,
            'title' => 'Corel draw',
            'path' => 'public/file'
        ]);
    }
}
