<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Rules\FileTypeValidate;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $pageTitle = "Manage Department";
        $emptyMessage = "No data found";
        $departments = Department::latest()->paginate(getPaginate());
        return view('admin.department.index', compact('pageTitle', 'emptyMessage', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $department = new Department();
        $department->name = $request->name;
        $department->status = $request->status ? 1: 0;
        $path = imagePath()['department']['path'];
        $size = imagePath()['department']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $department->image = $filename;
        }
        $department->save();
        $notify[] = ['success', 'Department has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments,name,'.$request->id,
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $department = Department::findOrFail($request->id);
        $department->name = $request->name;
        $department->status = $request->status ? 1: 0;
        $path = imagePath()['department']['path'];
        $size = imagePath()['department']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $department->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $department->image = $filename;
        }
        $department->save();
        $notify[] = ['success', 'Department has been updated'];
        return back()->withNotify($notify);
    }
}
