<?php

namespace App\Http\Controllers;

use App\Models\quization;
use App\Models\quize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class QuizationController extends Controller
{
    public function index(){
        $data= quization::get();
        $quizePluck= quize::pluck('name', 'id');
        return view('backend.pages.quization.index', compact('data','quizePluck'));
    }

    public function store(Request $request){
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quize_id' => 'required',
        ]);

       try {
        // Generate slug from the name
        $slug = Str::slug($validatedData['name']);

        // Check if the slug already exists and make it unique if necessary
        $suffix = 2;
        while (quize::where('slug', $slug)->exists()) {
            $slug = Str::slug($validatedData['name'] . '-' . $suffix++);
        }
        // Create a new quiz instance
        $quization = new quization();
        $quization->name = $validatedData['name'];
        $quization->quize_id = $validatedData['quize_id'];
        $quization->slug = $slug; // Set the slug
        $quization->save();

        return redirect()->route('quization.index');
       } catch (\Exception $ex) {
        return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
    }

    }

    public function update( Request $request ,$id){

$validatedData=$request->validate([

    'name' => 'required|string',
    'quize_id' =>'required',

]);


try {
    $quization=quization::findOrFail($id);
    $quization->name = $validatedData['name'];
    $quization->quize_id = $validatedData['quize_id'];
    $quization->save();
    return redirect()->route('quization.index')->with('success', 'quization updated successfully');

} catch (\Exception $ex) {
    return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
}

    }

    public function destroy($id)
    {
        $quization = quization::query()->where('id', $id)->first();

        $status = $quization->delete();
        if ($status) {
            session()->flash('success', 'Successfully Deleted quization');
        } else {
            session()->flash('error', 'Not Successfully Deleted quization');
        }
        return redirect()->route('quization.index');
    }
}
