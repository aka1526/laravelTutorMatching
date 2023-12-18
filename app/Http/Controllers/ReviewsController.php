<?php

namespace App\Http\Controllers;

use App\Models\reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        // $tutor_id = $request->tutor_id ? $request->tutor_id : 1;
        $data['reviews'] = reviews::orderBy('review_id', 'asc')->paginate(5);
        return view('reviews.index', $data);

    }

    public function review(Request $request, $tutor_id){
        // dd($news);
        return view('reviews.index', compact('reviews'));
    }


    // create resource
    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'review_comment' => 'required',

        ]);

        $reviews = new reviews;
        $reviews->review_comment = $request->review_comment;
        $reviews->save();

        return redirect()->route('reviews.index')->with('success', 'เพิ่มข่าวสำเร็จแล้ว.');
        // return view('news.create');


    }

    
}