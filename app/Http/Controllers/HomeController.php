<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Cache::remember("courses", 600, function () {
            return Course::query()->orderBy('created_at', 'DESC')->paginate(PAGINATE_COUNT);
        });
        return view('frontend.home', compact('courses'));
    }
}
