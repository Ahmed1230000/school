<?php

namespace App\Http\Controllers;

use App\Helpers\LogError;
use App\Http\Requests\ClassRoomStoreFormRequest;
use App\Http\Requests\ClassRoomUpdateFormRequest;
use App\Service\ClassRoomService;
use App\Service\StudentService;
use App\Service\TeacherService;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    use LogError;
    protected $classRoomService;
    protected $teacherService;
    protected $studentService;

    public function __construct(
        TeacherService  $teacherService,
        ClassRoomService $classRoomService,
        StudentService  $studentService
    ) {
        $this->classRoomService = $classRoomService;
        $this->teacherService = $teacherService;
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classRooms = $this->classRoomService->getAll();
            $students = $this->studentService->getAll();
            $teachers = $this->teacherService->getAll();
            return view('class-room.index-class-room', compact('classRooms', 'students', 'teachers'));
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to fetch class rooms!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = $this->studentService->getAll();
        $teachers = $this->teacherService->getAll();
        return view('class-room.create-class-room', compact('students', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomStoreFormRequest $request)
    {
        try {
            $this->classRoomService->create($request->validated());
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to create class room!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $classRoom = $this->classRoomService->getById($id);
            return view('class-room.show-class-room', compact('classRoom'));
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to fetch class room details!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $classRoom = $this->classRoomService->getById($id);
            $teachers = $this->teacherService->getAll();
            $students = $this->studentService->getAll();
            return view('class-room.edit-class-room', compact('classRoom', 'teachers', 'students'));
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to fetch class room for editing!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomUpdateFormRequest $request, string $id)
    {
        try {
            $this->classRoomService->update($request->validated(), $id);
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to update class room!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->classRoomService->delete($id);
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back()->with('error', 'Failed to delete class room!');
        }
    }
}
