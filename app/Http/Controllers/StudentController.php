<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use DataTables;

class StudentController extends Controller
{
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::select('roll_no', 'name', 'age', 'created_at')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('students.view');
    }

    public function search(Request $request)
    {
        $students = Student::filter($request->all())->get();
        return response()->json([
            'students' => $students,
        ]);
    }
    public function add()
    {
        return view('students.add');
    }
    public function create()
    {
        $validatedData = request()->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/u',
            'roll_no' => 'required|unique:students',
            'age' => 'required|numeric|min:15|max:35',
        ]);
        $student = new Student();
        $student->name = request()->name;
        $student->roll_no = request()->roll_no;
        $student->age = request()->age;
        $student->save();
        return redirect('/students/add')->with('insertinfo', 'Student inserted');
    }
    public function showData()
    {
        $student = Student::All();
        return view('students.update', ['students' => $student]);
    }
    public function studentByRollNo(Request $request)
    {
        $student = Student::filter($request->all())->get();
        return response()->json([
            'student' => $student,
        ]);
    }
    public function edit(Request $request)
    {
        $validatedData = request()->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/u',
            'roll_no' => 'required',
            'age' => 'required|numeric|min:15|max:35',
        ]);
        $student = Student::find($request->id);
        $student->name = $request->input('name');
        $student->age = $request->input('age');
        $student->update();
        return redirect('/students/update')->with('updateinfo', 'Student updated');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::select('id', 'roll_no', 'name', 'age', 'created_at')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<button type="button" name="delete" class="delete btn btn-danger btn-sm" id="' . $data->id . '">Delete</button>';

                    return $btn;
                })
                ->editColumn('created_at', function ($data) {
                    $formatedDate = ( $data->created_at)->format('Y-m-d');
                    return $formatedDate;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('students.delete');
    }
    public function destroy(Request $request)
    {
        $student = Student::find($request->id);
        $student->delete();
        return redirect('/students/delete');
    }
}
