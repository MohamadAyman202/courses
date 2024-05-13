<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{

    private $var;
    public function __construct()
    {
        // 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::query()->orderBy('created_at', 'DESC')->paginate(PAGINATE_COUNT);
        return view('backend.pages.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "course_name" => ['required', 'string'],
            'photo' => ['required', 'mimes:jpg,svg,jpeg,png,gif']
        ]);

        try {
            $data = $request->except('_token', 'photo');
            $data['slug'] = str()->slug($data['course_name']);
            $data['admin_id'] = auth()->user()->id;

            if ($request->hasFile('photo')) {
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/course/$image_name";
            }

            $course = Course::query()->where('slug', $data['slug']);
            if ($course->count() == 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = Course::query()->create($data);

            if ($status) {
                $request->file('photo')->move(public_path("uploads/course/"), $image_name);
                session()->flash('success', 'Successfully Created Course');
            } else {
                session()->flash('error', 'Not Successfully Created Course');
            }
            return redirect()->route('admin.courses.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            "course_name" => ['required', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,svg,jpeg,png']
        ]);
        try {
            $data = $request->except('_token', 'photo');
            $data['slug'] = str()->slug($data['course_name']);
            $data['admin_id'] = auth()->user()->id;

            $course = Course::query()->where('slug', $slug);

            if ($request->hasFile('photo')) {
                unlink($course->first()->photo);
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/course/$image_name";
            }

            if ($course->count() != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = $course->first()->fill($data)->save();

            if ($status) {
                if ($request->hasFile('photo')) {
                    $request->file('photo')->move(public_path("uploads/course/"), $image_name);
                }
                session()->flash('success', 'Successfully Updated Course');
            } else {
                session()->flash('error', 'Not Successfully Updated Course');
            }
            return redirect()->route('admin.courses.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $course = Course::query()->where('slug', $slug)->first();
        if ($course) {
            unlink($course->photo);
            $status = $course->delete();
            if ($status) {
                session()->flash('success', 'Successfully Deleted Course');
            } else {
                session()->flash('error', 'Not Successfully Deleted Course');
            }
        }
        return redirect()->route('admin.courses.index');
    }
}
