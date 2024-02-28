<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::query()->orderBy('created_at', 'DESC')->get();
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
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           "course_name" => ['required', 'string'],
            'meta_description' => ['required', 'max:80', 'string'],
            'description' => ['required']
        ]);
        try {
            $data = $request->except('_token');
            $data['slug'] = str()->slug($data['course_name']);
            $data['teacher_id'] = auth()->user()->id;

            $course = Course::query()->where('slug', $data['slug']);
            if ($course->count() > 1) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = Course::query()->create($data);

            if ($status) {
                session()->flash('success', 'Successfully Created Course');
            } else {
                session()->flash('error', 'Not Successfully Created Course');
            }
            return redirect()->route('teacher.courses.index');
        }catch (\Exception $ex) {
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
            'meta_description' => ['required', 'max:80', 'string'],
            'description' => ['required']
        ]);
        try {
            $data = $request->except('_token');
            $data['slug'] = str()->slug($data['course_name']);
            $data['teacher_id'] = auth()->user()->id;

            $course = Course::query()->where('slug', $slug);
            if ($course->count() > 1) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = $course->first()->fill($data)->save();

            if ($status) {
                session()->flash('success', 'Successfully Updated Course');
            } else {
                session()->flash('error', 'Not Successfully Updated Course');
            }
            return redirect()->route('teacher.courses.index');

        }catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $course = Course::query()->where('slug', $slug);
        if ($course) {
            $status = $course->delete();

            if ($status) {
                session()->flash('success', 'Successfully Deleted Course');
            } else {
                session()->flash('error', 'Not Successfully Deleted Course');
            }
            return redirect()->route('teacher.courses.index');
        }
    }


}
