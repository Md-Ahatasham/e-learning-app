<?php
namespace App\Services\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;

class StudentService extends Controller {
    protected $repository;

    public function __construct(StudentRepository $repository){
        $this->repository = $repository;
    }

    public function getAllStudentList()
    {
        $studentList = $this->repository->getAllStudentList();
        return datatables($studentList)->addColumn('action', function ($row) {
            return '<a href="/students/' . $row->id . '" class="btn btn-primary btn-xs second"><em class="fa fa-edit"></em></a>
            <a href="/students/' . $row->id . '" onclick="deleteItem(event)" class="btn btn-danger btn-xs"><em class="fas fa-trash-alt"></em></a>';
        })
            ->addColumn('profile_photo', function ($row) {
                return '<a href="/students/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->profile_photo . '"></a>';
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('first_name', function ($row) {
                return $row->first_name;
            })
            ->addColumn('last_name', function ($row) {
                return $row->last_name;
            })
            ->rawColumns(['action', 'email', 'profile_photo', 'first_name', 'last_name'])->make(true);
    }

}
