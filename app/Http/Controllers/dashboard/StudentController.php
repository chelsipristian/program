<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Student $students)
    {
        $q = $request->input('q');

        $active = 'Student';

        $students = $students->when($q, function($query) use ($q) {
                        return $query->where('nisn', 'like', '%' .$q. '%')
                                     ->orwhere('nama', 'like', '%' .$q. '%')
                                     ->orwhere('alamat', 'like', '%' .$q. '%')
                                     ->orwhere('asal_sekolah', 'like', '%' .$q. '%')
                                     ->orwhere('tanggal_lahir', 'like', '%' .$q. '%')
                                     ->orwhere('jenis_kelamin', 'like', '%' .$q. '%')
                                     ->orwhere('email', 'like', '%' .$q. '%');                                   
        })
        ->paginate(10);
        $request = $request->all();
        return view('dashboard/student/list', [
            'students' => $students,
            'request'  => $request,
            'active'   => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Student';
        return view('dashboard/student/form', [
            'active' => $active,
            'button' => 'Create',
            'url'    => 'dashboard.student.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn'          =>  'required|unique:App\Models\Student,nisn',
            'nama'          =>  'required',
            'alamat'        =>  'required',
            'asal_sekolah'  =>  'required',
            'tanggal_lahir' =>  'required',
            'jenis_kelamin' =>  'required',
            'email'         =>  'required',
            'thumbnail'     =>  'required|image'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.student.create')
                ->withErrors($validator)
                ->withInput();
            }else {
                $student = new Student(); //Tambahkan ini untuk membuat objek Student
                $image   = $request->file('thumbnail');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->putFileAs('public/student', $image, $filename);
                
                $student->nisn = $request->input('nisn');
                $student->nama = $request->input('nama');
                $student->alamat = $request->input('alamat');
                $student->asal_sekolah = $request->input('asal_sekolah');
                $student->tanggal_lahir = $request->input('tanggal_lahir');
                $student->jenis_kelamin = $request->input('jenis_kelamin');
                $student->email = $request->input('email');
                $student->thumbnail = $filename; // Ganti dengan nama file yang baru diupload
                $student->save();
    
                $messageKey = 'dashboard.student.update';
                return redirect()
                                 ->route('dashboard.student')
                                 ->with('message', __('penambahan data berhasil', ['nisn'=>$request->input('nisn')]));
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $active = 'Student';
        return view('dashboard/student/form', [
            'active'    => $active,
            'student'   => $student,
            'button'    => 'Update',
            'url'       => 'dashboard.student.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'nisn'          =>  'required|unique:App\Models\Student,nisn,'.$student->nisn,
            'nama'          =>  'required',
            'alamat'        =>  'required',
            'asal_sekolah'  =>  'required',
            'tanggal_lahir' =>  'required',
            'jenis_kelamin' =>  'required',
            'email'         =>  'required',
            'thumbnail'     =>  'image'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('dahboard.student.update', $student->nisn)
                ->withErrors($validator)
                ->withInput();
        }else {
            //$student = new Student(); //Tambahkan ini untuk membuat objek Student
            if($request->hasFile('thumbnail')){
                $image   = $request->file('thumbnail');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('local')->putFileAs('public/student', $image, $filename);
                $student->thumbnail = $filename; //Ganti dengan nama file yang baru diupload
            }
            $student->nisn = $request->input('nisn');
            $student->nama = $request->input('nama');
            $student->alamat = $request->input('alamat');
            $student->asal_sekolah = $request->input('asal_sekolah');
            $student->tanggal_lahir = $request->input('tanggal_lahir');
            $student->jenis_kelamin = $request->input('jenis_kelamin');
            $student->email = $request->input('email');
            $student->save();

            $messageKey = 'dashboard.student.update';
            return redirect()
                             ->route('dashboard.student')
                             ->with('message', __('update data berhasil', ['nisn'=>$request->input('nisn')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        {
            $active = 'Student';
            $nisn = $student->nisn;
    
            $student->delete();
            $messageKey = 'dashboard.student.delete';
            return redirect()
                    ->route('dashboard.student')
                    ->with('message', __('delete data berhasil', ['nisn' => $nisn]));
                    
        }
    }
}
