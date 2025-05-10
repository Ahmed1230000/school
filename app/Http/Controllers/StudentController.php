<?php

namespace App\Http\Controllers;

use App\Helpers\LogError;
use App\Http\Requests\StudentStoreFormRequest;
use App\Http\Requests\StudentUpdateFormRequest;
use App\Service\StudentService;
use App\Service\TeacherService;

class StudentController extends Controller
{
    use LogError;

    protected $teacherService;

    protected $studentService;
    public function __construct(
        StudentService $studentService,
        TeacherService $teacherService
    ) {
        $this->studentService = $studentService;
        $this->teacherService = $teacherService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = $this->studentService->getAll();
            $teacher = $this->teacherService->getALl();
            return view('students.index-student', compact('students', 'teacher'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create-student');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreFormRequest $request)
    {
        try {
            $this->studentService->create($request->validated());
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {
            $student = $this->studentService->getById($id);
            return view('students.show-student', compact('student'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $student = $this->studentService->getById($id);
            return view('students.edit-student', compact('student'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateFormRequest $request, string $id)
    {
        try {
            $this->studentService->update($request->validated(), $id);
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->studentService->delete($id);
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }
}
