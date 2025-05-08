<?php

namespace App\Http\Controllers;

use App\Helpers\LogError;
use App\Http\Requests\TeacherStoreFormRequest;
use App\Http\Requests\TeacherUpdateFormRequest;
use App\Service\StudentService;
use App\Service\TeacherService;

class TeacherController extends Controller
{
    use LogError;
    protected $teacherService;
    protected $studentService;

    public function __construct(
        TeacherService $teacherService,
        StudentService $studentService
    ) {
        $this->teacherService = $teacherService;
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $teachers = $this->teacherService->getAll();
            return view('teachers.index-teacher', compact('teachers'));
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
        $students = $this->studentService->getAll();
        return view('teachers.create-teacher', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherStoreFormRequest $request)
    {
        try {
            $this->teacherService->create($request->validated());
            return redirect()->route('teachers.index');
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
            $teacher = $this->teacherService->getById($id);

            return view('teachers.show-teacher', compact('teacher'));
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
            $teacher = $this->teacherService->getById($id);
            $students = $this->studentService->getAll();

            return view('teachers.edit-teacher', compact('teacher', 'students'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherUpdateFormRequest $request, string $id)
    {
        try {
            $this->teacherService->update($request->validated(), $id);
            return redirect()->route('teachers.index');
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
            $this->teacherService->delete($id);
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }
}
