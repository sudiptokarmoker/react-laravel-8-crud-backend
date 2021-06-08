<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    private $status = 200;

    public function createStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "phone" => "required|numeric",
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }
        /**
         * Now begain opertion
         */
        try {
            $studentArray = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "full_name" => $request->first_name . " " . $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone,
            ];
            $student = Student::create($studentArray);
            if (!is_null($student)) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "student record created successfully", "data" => $student]);
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
            }
        } catch (\Exception $e) {
            return response()->json(["status" => "failed", "success" => false, "message" => $e->getMessage()]);
        }
    }
    /**
     * Edit students
     */
    public function editStudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }
        /**
         * Now begain main operation
         */
        try {
            $studentId = $request->id;
            $studentArray = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "full_name" => $request->first_name . " " . $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone,
            ];
            $student = Student::find($studentId);
            if (!is_null($student)) {
                $updated_status = Student::where("id", $studentId)->update($studentArray);
                if ($updated_status == 1) {
                    return response()->json(["status" => $this->status, "success" => true, "message" => "student detail updated successfully"]);
                } else {
                    return response()->json(["status" => "failed", "message" => "Whoops! failed to update, try again."]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(["status" => "failed", "success" => false, "message" => $e->getMessage()]);
        }
    }
    /**
     * Details of students
     */
    public function studentDetail($id)
    {
        $student = Student::find($id);
        if (!is_null($student)) {
            return response()->json(["status" => $this->status, "success" => true, "data" => $student]);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no student found"]);
        }
    }
    /**
     * Delete students
     */
    public function studentDelete($id)
    {
        $student = Student::find($id);
        if (!is_null($student)) {
            $delete_status = Student::where("id", $id)->delete();
            if ($delete_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "student record deleted successfully"]);
            } else {
                return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
            }
        } else {
            return response()->json(["status" => "failed", "message" => "Whoops! no student found with this id"]);
        }
    }
}
