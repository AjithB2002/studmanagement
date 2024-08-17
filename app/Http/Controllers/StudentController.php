<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{





    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all students from the database
        return response()->json(Student::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Create a new student
        $student = Student::create($validatedData);

        // Return the created student with a 201 status code
        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if student exists
        if ($student) {
            return response()->json($student, 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if student exists
        if ($student) {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
                'course' => 'sometimes|required|string|max:255',
                'age' => 'sometimes|required|integer|min:1',
            ]);

            // Update the student with the validated data
            $student->update($validatedData);

            return response()->json($student, 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if student exists
        if ($student) {
            // Delete the student
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
