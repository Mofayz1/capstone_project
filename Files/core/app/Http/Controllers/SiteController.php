<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\Language;
use App\Models\Location;
use App\Models\Department;
use App\Models\Page;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Doctor;
use App\Models\Advertise;
use App\Models\City;
use App\Models\Subscriber;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class SiteController extends Controller
{
  protected $activeTemplate;

  public function __construct()
  {
    $this->activeTemplate = activeTemplate();
  }

  public function index()
  {
    $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();
    if ($count == 0) {
      $page = new Page();
      $page->tempname = $this->activeTemplate;
      $page->name = 'HOME';
      $page->slug = 'home';
      $page->save();
    }
    $reference = @$_GET['reference'];
    if ($reference) {
      session()->put('reference', $reference);
    }
    $pageTitle = 'Home';
    $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
    $locations = Location::where('status', 1)->get();
    $citys = City::where('status', 1)->get();
    $departments = Department::where('status', 1)->get();
    return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'locations', 'departments', 'citys'));
  }

  public function pages($slug)
  {
    $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
    $pageTitle = $page->name;
    $sections = $page->secs;
    return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
  }

  public function doctor()
  {
    $pageTitle = "Doctor Listing";
    $emptyMessage = "No data found";
    $locations = Location::where('status', 1)->get();
    $citys = City::where('status', 1)->get();
    $departments = Department::where('status', 1)->get();
    $doctors = Doctor::where('status', 1)->inRandomOrder()->paginate(getPaginate());
    return view($this->activeTemplate . 'doctor', compact('pageTitle', 'doctors', 'locations', 'departments', 'emptyMessage', 'citys'));
  }


  public function doctorDetails($slug, $id)
  {
    $pageTitle = "Doctor Details";
    $doctor = Doctor::where('id', decrypt($id))->where('status', 1)->firstOrFail();
    return view($this->activeTemplate . 'doctor_details', compact('pageTitle', 'doctor'));
  }

  public function doctorDepartment($slug, $id)
  {
    $pageTitle = "Doctor Department";
    $emptyMessage = "No data found";
    $locations = Location::where('status', 1)->get();
    $citys = City::where('status', 1)->get();
    $departments = Department::where('status', 1)->get();
    $doctors = Doctor::where('status', 1)->where('department_id', $id)->inRandomOrder()->paginate(getPaginate());
    return view($this->activeTemplate . 'doctor', compact('pageTitle', 'doctors', 'locations', 'departments', 'emptyMessage', 'citys'));
  }

  public function contact()
  {
    $pageTitle = "Contact Us";
    $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
    return view($this->activeTemplate . 'contact', compact('pageTitle', 'sections'));
  }

  public function contactSubmit(Request $request)
  {
    $attachments = $request->file('attachments');
    $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');
    $this->validate($request, [
      'name' => 'required|max:191',
      'email' => 'required|max:191',
      'subject' => 'required|max:100',
      'message' => 'required',
    ]);
    $random = getNumber();
    $ticket = new SupportTicket();
    $ticket->name = $request->name;
    $ticket->email = $request->email;
    $ticket->priority = 2;

    $ticket->ticket = $random;
    $ticket->subject = $request->subject;
    $ticket->last_reply = Carbon::now();
    $ticket->status = 0;
    $ticket->save();

    $message = new SupportMessage();
    $message->supportticket_id = $ticket->id;
    $message->message = $request->message;
    $message->save();
    $notify[] = ['success', 'ticket created successfully!'];
    return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
  }

  public function changeLanguage($lang = null)
  {
    $language = Language::where('code', $lang)->first();
    if (!$language)
      $lang = 'en';
    session()->put('lang', $lang);
    return redirect()->back();
  }

  public function blog()
  {
    $pageTitle = "Blog";
    $blogs = Frontend::where('data_keys', 'blog.element')->paginate(getPaginate());
    $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
    return view($this->activeTemplate . 'blog', compact('blogs', 'pageTitle', 'sections'));
  }

  public function blogDetails($id, $slug)
  {
    $recentPosts = Frontend::where('data_keys', 'blog.element')->orderby('id', 'DESC')->take(8)->get();
    $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
    $pageTitle = "Blog Details";
    return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'recentPosts'));
  }

  public function footerMenu($slug, $id)
  {
    $data = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
    $pageTitle = $data->data_values->title;
    return view($this->activeTemplate . 'menu', compact('data', 'pageTitle'));
  }

  public function cookieAccept()
  {
    session()->put('cookie_accepted', true);
    return response()->json('Cookie accepted successfully');
  }

  public function placeholderImage($size = null)
  {
    $imgWidth = explode('x', $size)[0];
    $imgHeight = explode('x', $size)[1];
    $text = $imgWidth . '×' . $imgHeight;
    $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
    $fontSize = round(($imgWidth - 50) / 8);
    if ($fontSize <= 9) {
      $fontSize = 9;
    }
    if ($imgHeight < 100 && $fontSize > 30) {
      $fontSize = 30;
    }
    $image = imagecreatetruecolor($imgWidth, $imgHeight);
    $colorFill = imagecolorallocate($image, 100, 100, 100);
    $bgFill = imagecolorallocate($image, 175, 175, 175);
    imagefill($image, 0, 0, $bgFill);
    $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
    $textWidth = abs($textBox[4] - $textBox[0]);
    $textHeight = abs($textBox[5] - $textBox[1]);
    $textX = ($imgWidth - $textWidth) / 2;
    $textY = ($imgHeight + $textHeight) / 2;
    header('Content-Type: image/jpeg');
    imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
    imagejpeg($image);
    imagedestroy($image);
  }

  public function applyDoctor()
  {
    $pageTitle = "Apply As A Doctor";
    $departments = Department::where('status', 1)->latest()->get();
    $cities = City::where('status', 1)->select('id', 'name')->with('locations')->get();
    return view($this->activeTemplate . 'apply_doctor', compact('pageTitle', 'departments', 'cities'));
  }

  public function applyDoctorStore(Request $request)
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
    $doctor->save();
    $notify[] = ['success', 'Doctor has been requested'];
    return back()->withNotify($notify);
  }

  public function doctorSearchHomePage(Request $request)
  {
    $request->validate([
      'location_id' => 'nullable|exists:locations,id',
      'city_id' => 'nullable|exists:cities,id',
      'department_id' => 'nullable|exists:departments,id',
    ]);
    $locationId = $request->location_id;
    $cityId = $request->city_id;
    $departmentId = $request->department_id;
    $locationData = collect($locationId);
    $cityData = collect($cityId);
    $departmentData = collect($departmentId);
    $doctors = Doctor::where('status', 1);
    if ($locationId) {
      $doctors = $doctors->where('location_id', $locationId);
    }
    if ($cityId) {
      $doctors = $doctors->where('city_id', $cityId);
    }
    if ($departmentId) {
      $doctors = $doctors->where('department_id', $departmentId);
    }
    $doctors = $doctors->paginate(getPaginate());
    $locations = Location::where('status', 1)->get();
    $citys = City::where('status', 1)->get();
    $departments = Department::where('status', 1)->get();
    $pageTitle = "Doctor search";
    $emptyMessage = "No data found";
    return view($this->activeTemplate . 'doctor', compact('pageTitle', 'doctors', 'locations', 'departments', 'emptyMessage', 'locationData', 'cityData', 'departmentData', 'citys'));
  }

  public function doctorSearch(Request $request)
  {
    $request->validate([
      'location_id.*' => 'nullable|exists:locations,id',
      'city_id.*' => 'nullable|exists:cities,id',
      'department_id.*' => 'nullable|exists:departments,id',
    ]);
    $locationId = $request->location_id;
    $cityId = $request->city_id;
    $departmentId = $request->department_id;
    $search = $request->search;
    $locationData = collect($locationId);
    $cityData = collect($cityId);
    $departmentData = collect($departmentId);
    $doctors = Doctor::where('status', 1);
    if ($locationId) {
      $doctors = $doctors->whereIn('location_id', $locationId);
    }
    if ($cityId) {
      $doctors = $doctors->where('city_id', $cityId);
    }
    if ($departmentId) {
      $doctors = $doctors->whereIn('department_id', $departmentId);
    }
    if ($search) {
      $doctors = $doctors->where('name', 'like', "%$search%");
    }
    $doctors = $doctors->paginate(getPaginate());
    $locations = Location::where('status', 1)->get();
    $citys = City::where('status', 1)->get();
    $departments = Department::where('status', 1)->get();
    $pageTitle = "Doctor search";
    $emptyMessage = "No data found";
    return view($this->activeTemplate . 'doctor', compact('pageTitle', 'doctors', 'locations', 'departments', 'emptyMessage', 'locationData', 'cityData', 'departmentData', 'citys'));
  }

  public function contactWithDoctor(Request $request)
  {
    $request->validate([
      'doctor_id' => 'required|exists:doctors,id',
      'name' => 'required|max:80',
      'email' => 'required|max:80',
      'message' => 'required|max:500'
    ]);
    $doctor = Doctor::findOrFail($request->doctor_id);
    notify($doctor, 'CONTACT_DOCTOR', [
      'name' => $request->name,
      'email' => $request->email,
      'message' => $request->message
    ]);
    $notify[] = ['success', 'Contact message has been submitted'];
    return back()->withNotify($notify);
  }


  public function subscribe(Request $request)
  {
    $validator = FacadesValidator::make($request->all(), [
      'email' => 'required|email',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
    $if_exist = Subscriber::where('email', $request->email)->first();
    if (!$if_exist) {
      Subscriber::create([
        'email' => $request->email
      ]);
      return response()->json(['success' => 'Subscribed Successfully']);
    } else {
      return response()->json(['error' => 'Already Subscribed']);
    }
  }


  public function adclicked($id)
  {
    $ads = Advertise::where('id', decrypt($id))->firstOrFail();
    $ads->click += 1;
    $ads->save();
    return redirect($ads->redirect_url);
  }


}
