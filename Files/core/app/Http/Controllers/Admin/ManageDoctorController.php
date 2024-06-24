<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chember;
use App\Models\City;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ManageDoctorController extends Controller
{

    public function create()
    {
        $pageTitle = "Create Doctor";
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('locations')->get();
        return view('admin.doctor.create', compact('pageTitle', 'departments', 'cities'));
    }
    
    public function index()
    {
        $pageTitle = "Manage Doctor";
        $emptyMessage = "No data found";
        $doctors = Doctor::latest()->with('department')->paginate(getPaginate());
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments'));
    }

    public function approved()
    {
        $pageTitle = "Manage Doctor";
        $emptyMessage = "No data found";
        $doctors = Doctor::where('status', 1)->latest()->with('department')->paginate(getPaginate());
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments'));
    }

    public function pending()
    {
        $pageTitle = "Manage Doctor";
        $emptyMessage = "No data found";
        $doctors = Doctor::where('status', 0)->latest()->with('department')->paginate(getPaginate());
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments'));
    }

    public function banned()
    {
        $pageTitle = "Manage Doctor";
        $emptyMessage = "No data found";
        $doctors = Doctor::where('status', 2)->latest()->with('department')->paginate(getPaginate());
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments'));
    }


    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:doctors,id'
        ]);
        $doctor = Doctor::findOrFail($request->id);
        $doctor->featured = 1;
        $doctor->save();
        $notify[] = ['success', 'Include this doctor featured list'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:doctors,id'
        ]);
        $doctor = Doctor::findOrFail($request->id);
        $doctor->featured = 0;
        $doctor->save();
        $notify[] = ['success', 'Remove this doctor featured list'];
        return back()->withNotify($notify);
    }

    public function approvedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:doctors,id'
        ]);
        $doctor = Doctor::findOrFail($request->id);
        $doctor->status = 1;
        $doctor->save();
        $notify[] = ['success', 'Doctor has been approved'];
        return back()->withNotify($notify);
    }

    public function bannedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:doctors,id'
        ]);
        $doctor = Doctor::findOrFail($request->id);
        $doctor->status = 2;
        $doctor->save();
        $notify[] = ['success', 'Doctor has been canceled'];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60|unique:doctors,email',
            'phone' => 'required|max:40|unique:doctors,phone',
            'location' => 'required|exists:locations,id',
            'city' => 'required|exists:cities,id',
            'department' => 'required|exists:departments,id',
            'qualification' => 'required|max:255',
            'currently_work' => 'required|max:255',
            'start_time' => 'required',
            'end_time' => 'required|after:time_start',
            'appoinment' => 'required|max:60',
            'designation' => 'required|max:60',
            'specialty' => 'required|max:255',
            'institute' => 'required|max:255',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->department_id = $request->department;
        $doctor->location_id = $request->location;
        $doctor->city_id = $request->city;
        $doctor->qualification = $request->qualification;
        $doctor->present_work = $request->currently_work;
        $doctor->start_time = $request->start_time;
        $doctor->end_time = $request->end_time;
        $doctor->appoinment = $request->appoinment;
        $doctor->specialty = $request->specialty;
        $doctor->designation = $request->designation;
        $doctor->institute = $request->institute;
        $path = imagePath()['doctor']['path'];
        $size = imagePath()['doctor']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $doctor->image = $filename;
        }
        $doctor->status = $request->status ? 1 : 2;
        $doctor->save();
        notify($doctor, 'DOCTOR_CREATE',[
            'appoinment'=> $doctor->appoinment,
            'start_time' => $doctor->start_time,
            'end_time' => $doctor->end_time
        ]);
        $notify[] = ['success', 'Doctor has been created'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Doctor Update";
        $doctor = Doctor::findOrFail($id);
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('locations')->get();
        return view('admin.doctor.edit', compact('pageTitle', 'doctor', 'departments','cities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60|unique:doctors,email,'.$id,
            'phone' => 'required|max:40|unique:doctors,phone,'.$id,
            'location' => 'required|exists:locations,id',
            'city' => 'required|exists:cities,id',
            'department' => 'required|exists:departments,id',
            'qualification' => 'required|max:255',
            'currently_work' => 'required|max:255',
            'start_time' => 'required',
            'end_time' => 'required|after:time_start',
            'appoinment' => 'required|max:60',
            'designation' => 'required|max:60',
            'specialty' => 'required|max:255',
            'institute' => 'required|max:255',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $doctor = Doctor::findOrFail($id);
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->department_id = $request->department;
        $doctor->location_id = $request->location;
        $doctor->city_id = $request->city;
        $doctor->qualification = $request->qualification;
        $doctor->present_work = $request->currently_work;
        $doctor->start_time = $request->start_time;
        $doctor->end_time = $request->end_time;
        $doctor->appoinment = $request->appoinment;
        $doctor->specialty = $request->specialty;
        $doctor->designation = $request->designation;
        $doctor->institute = $request->institute;
        $path = imagePath()['doctor']['path'];
        $size = imagePath()['doctor']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $doctor->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $doctor->image = $filename;
        }
        $doctor->status = $request->status ? 1 : 2;
        $doctor->save();
        $notify[] = ['success', 'Doctor has been updated'];
        return back()->withNotify($notify);
    }

    public function departmentSearch(Request $request)
    {
        $request->validate([
            'departmentId' => 'required|exists:departments,id'
        ]);
        $department = Department::find($request->departmentId);
        $pageTitle = "Doctor search by department " . $department->name;
        $emptyMessage = "No data found";
        $departmentId = $request->departmentId;
        $doctors = Doctor::where('department_id', $request->departmentId)->with('department')->latest()->paginate(getPaginate());
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments', 'departmentId'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $search = $request->search;
        $pageTitle = 'Doctor search by - ' . $search;
        $emptyMessage = "No data found";
        $departments = Department::where('status', 1)->select('id', 'name')->get();
        $doctors = Doctor::where('name', 'like', "%$search%")->with('department')->latest()->paginate(getPaginate());
        return view('admin.doctor.index', compact('pageTitle', 'emptyMessage', 'doctors', 'departments', 'search'));
    }

    public function chemberList($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctorId = $doctor->id;
        $pageTitle = $doctor->name ." Chember List";
        $emptyMessage = "No data found";
        $locations = Location::where('status', 1)->with('city')->get();
        $chembers = Chember::where('doctor_id', $id)->with('location', 'location.city')->paginate(getPaginate());
        return view('admin.doctor.chember', compact('pageTitle', 'emptyMessage', 'chembers', 'locations', 'doctorId'));
    }

    public function chemberStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'doctor' => 'required|exists:doctors,id',
            'location' => 'required|exists:locations,id',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'appoinment' => 'required|max:60',
            'email' => 'required|max:60'
        ]);
        $chember = new Chember();
        $chember->name = $request->name;
        $chember->doctor_id = $request->doctor;
        $chember->location_id = $request->location;
        $chember->start_time = $request->start_time;
        $chember->end_time = $request->end_time;
        $chember->appoinment = $request->appoinment;
        $chember->email = $request->email;
        $chember->save();
        $notify[] = ['success', 'Chember has been created'];
        return back()->withNotify($notify);
    }

    public function chemberUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:chembers,id',
            'name' => 'required|max:255',
            'doctor' => 'required|exists:doctors,id',
            'location' => 'required|exists:locations,id',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'appoinment' => 'required|max:60',
            'email' => 'required|max:60'
        ]);
        $chember = Chember::findOrFail($request->id);
        $chember->name = $request->name;
        $chember->doctor_id = $request->doctor;
        $chember->location_id = $request->location;
        $chember->start_time = $request->start_time;
        $chember->end_time = $request->end_time;
        $chember->appoinment = $request->appoinment;
        $chember->email = $request->email;
        $chember->save();
        $notify[] = ['success', 'Chember has been updated'];
        return back()->withNotify($notify); 
    }


    public function chemberDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:chembers,id',
        ]);
        $chember = Chember::findOrFail($request->id);
        $chember->delete();
        $notify[] = ['success', 'Chember has been deleted'];
        return back()->withNotify($notify); 
    }
}
