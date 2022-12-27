<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    //this method is to view Student for view page
    public function viewStudents(Request $request)
    {
        return view('students.view');
    }

    //this method is to search and draw students according to date
    public function getStudentListByDate()
    {
        $studentQuery = Student::query();
        $date = (!empty($_GET["date"])) ? ($_GET["date"]) : ('');
        //check the date is exist
        if ($date) {
            $date = date('Y-m-d', strtotime($date));
            $studentQuery->whereRaw("date(students.created_at) = '" . $date  . "'");
        }
        $data = $studentQuery->select('id', 'roll_no', 'name', 'age', 'study_year', 'created_at')->get();

        return datatables()->of($data)        
            ->editColumn('created_at', function ($data) {
                $formatedDate = ($data->created_at)->format('Y-m-d');

                return $formatedDate;
            })
            ->make(true);
    }

    //this method to upload add student page
    public function uploadAddForm()
    {
        return view('students.add');
    }

    //this method is to add new student to db
    public function createNewStudent(Request $request)
    {
        $validatedData = request()->validate([
            'name' => ['required', 'alpha_spaces'],
            'roll_no' => ['required', Rule::unique('students')->where(function ($query) use ($request) {

                return $query
                    ->whereroll_no($request->roll_no)
                    ->wherestudy_year($request->study_year);
            }), 'rollno_pattern'],
            'age' => ['required', 'numeric', 'min:15', 'max:35'],
            'study_year' => ['required', 'study_year_pattern'],
        ]);
        $student = new Student();
        $student->name = $request->name;
        $student->roll_no = $request->roll_no;
        $student->age = $request->age;
        $student->study_year = $request->study_year;
        $student->save();

        return redirect('/students/add')->with('insertinfo', 'Student inserted');
    }

    //this method is to draw rollno from db to sho
    public function rollNoByYear(Request $request)
    {
        $student = Student::filter($request->all())->get();

        return response()->json([
            'student' => $student,
        ]);
    }

    //this method is to upload update page
    public function uploadUpdateForm()
    {
        return view('students.update');
    }

    //this method is to search student by roll no
    public function getstudentByRollNo(Request $request)
    {
        $student = Student::find($request->id);

        return response()->json([
            'student' => $student,
        ]);
    }

    //this metho is to update student data
    public function editStudent(Request $request)
    {
        $validatedData = request()->validate([
            'name' => ['required', 'alpha_spaces'],
            'roll_no' => ['required'],
            'age' => ['required', 'numeric', 'min:15', 'max:35'],
        ]);
        $student = Student::find($request->id);
        $student->name = $request->input('name');
        $student->age = $request->input('age');
        $student->update();

        return redirect('/students/update')->with('updateinfo', 'Student updated');
    }

    //this method is draw data from db to delete students
    public function getStudentListToDelete(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::select('id', 'roll_no', 'name', 'age', 'study_year', 'created_at')->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<button type="button" name="delete" class="delete btn btn-danger btn-sm" id="' . $data->id . '"><i class="bi bi-trash3"></i></button>';

                    return $btn;
                })
                ->editColumn('created_at', function ($data) {
                    $formatedDate = ($data->created_at)->format('Y-m-d');

                    return $formatedDate;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('students.delete');
    }

    //this method is to delete student
    public function destroyStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->delete();

        return redirect('/students/delete');
    }
}
