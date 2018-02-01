<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Branch;
use App\Course;
use Grafika\Grafika;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $promos = Promo::with(['branch', 'createdBy', 'promoCourses'])->get();
        return view('promos.index', compact('promos'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('promos.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'body' => 'required',
        ]);

        $promo = Promo::create([
            'title' => $request->title,
            'body' => $request->body,
            'banner_url' => $request->hasFile('promo_banner') ? $request->file('promo_banner')->store('promo-images', 'public') : null,
            'start_date' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d'),
            'end_date' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d'),
            'branch_id' => auth()->user()->branch_id,
            'created_by' => auth()->user()->id,
        ]);

        // if there is image and its > 100kb or its height is > 400, resize it
        if ($promo->banner_url && ($request->file('promo_banner')->getClientSize() > 100000 || getimagesize($request->file('promo_banner'))[1] > 400)) {
            $editor = Grafika::createEditor();
            $editor->open($image, public_path() .'\\'. str_replace('/', '\\', $promo->banner_url));
            $editor->resizeExactHeight($image, 400);
            $editor->save($image, public_path() .'\\'. str_replace('/', '\\', $promo->banner_url));
        }

        foreach ($request->course_names as $key => $courseName) {
            $promo->promoCourses()->create([
                'name' => $courseName,
                'price' => $request->course_prices[$key],
            ]);
        }

        return redirect()->route('promos.index');
    }

    public function edit(Promo $promo)
    {
        $courses = Course::all();
        return view('promos.edit', compact('promo', 'courses'));
    }

    public function update(Request $request, Promo $promo)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'body' => 'required',
        ]);

        $promo->update([
            'title' => $request->title,
            'body' => $request->body,
            'banner_url' => $request->hasFile('promo_banner') ? $request->file('promo_banner')->store('promo-images', 'public') : $promo->banner_url,
            'start_date' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d'),
            'end_date' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d'),
        ]);

        // if image is new and its > 100kb or its height is > 400, resize it
        if ($request->hasFile('promo_banner') && ($request->file('promo_banner')->getClientSize() > 100000 || getimagesize($request->file('promo_banner'))[1] > 400)) {
            $editor = Grafika::createEditor();
            $editor->open($image, public_path() .'\\'. str_replace('/', '\\', $promo->banner_url));
            $editor->resizeExactHeight($image, 400);
            $editor->save($image, public_path() .'\\'. str_replace('/', '\\', $promo->banner_url));
        }

        // We will delete all promoCourse related the current promo
        // and create a new record
        foreach ($promo->promoCourses as $key => $promoCourse) {
            $promoCourse->delete();
        }

        foreach ($request->course_names as $key => $courseName) {
            $promo->promoCourses()->create([
                'name' => $courseName,
                'price' => $request->course_prices[$key],
            ]);
        }

        return redirect()->route('promos.index');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('promos.index');
    }
}
