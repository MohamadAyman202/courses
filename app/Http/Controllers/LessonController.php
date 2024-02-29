<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['lessons'] = Lesson::query()->orderBy('created_at','DESC')->paginate(PAGINATE_COUNT);
        $data['courses'] = auth()->user()->courses;
        return view('backend.pages.lessons.index', compact('data'));
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
        $message = ['course_id' => 'The Course Is Required'];
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $this->validate($request, [
            'title' => ['required', 'string'],
            'course_video' => ['required', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:20000'],
            'time_video' => ['required', "regex:$regex"],
            'course_id'=> ['required']
        ], $message);

        try {
            $data = $request->except('_token', 'course_video');
            $data['slug'] = str()->slug($data['title']);

            if ($request->hasFile('course_video')) {
                $video_name = time() . '.' . $request->file('course_video')->extension();
                $data['course_video'] = "uploads/videos/$video_name";
            }

            $count_slug = Lesson::query()->where('slug', $data['slug'])->count();
            if ($count_slug == 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = Lesson::query()->create($data);

            if ($status) {
                $request->file('course_video')->move(public_path("uploads/videos/"), $video_name);
                session()->flash('success', 'Successfully Created Lesson');
            } else {
                session()->flash('error', 'Not Successfully Created Lesson');
            }

            return redirect()->route('teacher.lessons.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $courseDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $courseDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $message = ['course_id' => 'The Course Is Required'];
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $this->validate($request, [
            'title' => ['required', 'string'],
            'course_video' => ['nullable', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:20000'],
            'time_video' => ['required', "regex:$regex"],
            'course_id'=> ['required']
        ], $message);

        try {
            $data = $request->except('_token', 'course_video');
            $data['slug'] = str()->slug($data['title']);

            $lesson = Lesson::query()->where('slug', $slug);
            if ($request->hasFile('course_video')) {
                unlink($lesson->first()->course_video);
                $video_name = time() . '.' . $request->file('course_video')->extension();
                $data['course_video'] = "uploads/videos/$video_name";
            }

            if ($lesson->count() != 0) {
                $data['slug'] = $data['slug'] . '-' . time();
            }

            $status = $lesson->first()->fill($data)->save();

            if ($status) {
                if ($request->hasFile('course_video')) {
                    $request->file('course_video')->move(public_path("uploads/videos/"), $video_name);
                }
                session()->flash('success', 'Successfully Created Lesson');
            } else {
                session()->flash('error', 'Not Successfully Created Lesson');
            }

            return redirect()->route('teacher.lessons.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $lesson = Lesson::query()->where('slug', $slug)->first();

        if ($lesson) {
            unlink($lesson->course_video);
            $status = $lesson->delete();

            if ($status) {
                session()->flash('success', 'Successfully Deleted Lesson!');
            } else {
                session()->flash('success', 'Successfully Deleted Lesson!');
            }
        }
        return redirect()->back();
    }
}
