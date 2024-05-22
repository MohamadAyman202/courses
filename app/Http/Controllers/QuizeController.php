<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizeRequest;
use App\Models\Lesson;
use App\Models\quize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class QuizeController extends Controller
{
    public function index()
    {
        $data = quize::get();
        $lessons = Lesson::pluck('title', 'id');
        return view('backend.pages.guizes.index', compact('data', 'lessons'));
    }

    public function store(Request $request)
    {
        try {

            $data = $this->data($request);
            // Generate slug from the name
            $data['slug'] = Str::slug($data['name']);

            // Check if the slug already exists and make it unique if necessary
            $suffix = 2;
            while (quize::where('slug', $data['slug'])->exists()) {
                $data['slug'] = Str::slug($data['name'] . '-' . $suffix++);
            }
            quize::create($data);

            return redirect()->route('quize.index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }


    public function update(StoreQuizeRequest $request, $id)
    {
        try {
            // Find the quiz by ID
            $quiz = quize::findOrFail($id);
            // Update quiz data
            $quiz->name = $request['name'];
            $quiz->lesson_id = $request['lesson_id'];
            $quiz->status = $request['status'];
            $quiz->end_time = $request['end_time'];
            $quiz->again_quize = $request['again_quize'];
            $quiz->score = $request['score'];
            $quiz->save();
            return redirect()->route('quize.index')->with('success', 'Quiz updated successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
    public function destroy($slug)
    {
        $quize = quize::query()->where('slug', $slug)->first();

        $status = $quize->delete();
        if ($status) {
            session()->flash('success', 'Successfully Deleted quize');
        } else {
            session()->flash('error', 'Not Successfully Deleted quize');
        }
        return redirect()->route('quize.index');
    }

    public function data($request)
    {
        $data = $request->except('_token');
        return $data;
    }
}
