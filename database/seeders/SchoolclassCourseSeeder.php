<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Schoolclass;
use Illuminate\Support\Str;
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

        Schoolclass::create([
            'teacher_id' => null,
            'name' => 'X TEI 1',
            'information' => 'Kelas 10 jurusan tei batch 1'
        ]);

        $classes =  [1,2];
        $course1 = new Course;
        $course1->name = 'Desain Grafis X RPL';
        $course1->information = 'Pelajaran dg kelas x rpl';
        $course1->save();
        $course1->schoolclasses()->attach($classes);

        $course2 = new Course;
        $course2->name = 'Pemrograman Dasar X RPL';
        $course2->information = 'Pelajaran pd kelas x rpl';
        $course2->save();
        $course2->schoolclasses()->attach($classes);

        $course3 = new Course;
        $course3->name = 'Elektronika X TEI';
        $course3->information = 'Pelajaran elektronika kelas x rpl';
        $course3->save();
        $course3->schoolclasses()->attach([3]);

        Subjectmatter::create([
            'course_id' => $course1->id,
            'teacher_id' => 1,
            'title' => 'Corel Draw',
            'details' => 'Ini adalah pelajaran tentang corel draw untuk kelas xi',
            'path' => 'public/',
            'link' => 'https://www.youtube.com/embed/b8oQqADRbTE',
        ]);

        Subjectmatter::create([
            'course_id' => $course1->id,
            'teacher_id' => 1,
            'title' => 'Adobe Photoshop',
            'details' => 'Ini adalah pelajaran tentang adobe photoshop untuk kelas xi',
            'path' => 'public/',
            'link' => 'https://www.youtube.com/embed/A9pWXs_2QD4E',
        ]);

        Subjectmatter::create([
            'course_id' => $course2->id,
            'teacher_id' => 2,
            'title' => 'Algoritma dasar',
            'details' => 'Ini adalah pelajaran tentang algoritma dasar untuk kelas xi',
            'path' => 'public/',
            'link' => 'https://www.youtube.com/embed/5JuNp0o4YEE'
        ]);

        Subjectmatter::create([
            'course_id' => $course3->id,
            'teacher_id' => 2,
            'title' => 'Analisa dan perhitungan listrik',
            'details' => 'Ini adalah pelajaran tentang kelistrikan untuk kelas xi',
            'path' => 'public/',
            'link' => 'https://www.youtube.com/embed/s9A2EfcoBQg'
        ]);

    }
}
