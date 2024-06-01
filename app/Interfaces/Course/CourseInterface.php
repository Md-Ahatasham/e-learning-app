<?php
namespace App\Interfaces\Course;

interface CourseInterface {
    public function getAllCourse();
    public function storeCourse($request);
    public function getCourseById($id);
}