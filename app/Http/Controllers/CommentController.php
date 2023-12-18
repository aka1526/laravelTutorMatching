<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;


class CommentController extends Controller
{
    // comment
    public function userComment(Request $request, $id)
    {
        //dd($request->All());
        $validatedData = $request->validate([
            'comment' => 'required|max:255',
            'course_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user_id = $request->input('user_id');
        $comment = $request->input('comment');
        $rating = $request->input('rating');
        $course_id = $request->input('course_id');

        $courses = Course::where('id', $course_id)->first();
        $tutor_id = $courses->tutor_id;
        $act = false;
        $act = Comment::create([
            'comment' => $comment,
            'tutor_id' => $id,
            'course_id' => $course_id,
            'user_id' => $user_id,
            'rating' => $rating,
        ]);

        // dd($userId,$comment);
        if ($act) {
            return redirect()->back()->with('success', 'เพิ่มความคิดเห็นสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'Data Error');
        }

    }


    //-------------------------------------delete-------------------------------------------


    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }


    //-------------------------------------delete(user)-------------------------------------------

    public function destroy(Request $request, $id)
    {
        $comment_id = isset($request->id) ? $request->id : $id;

        $comment = Comment::find($comment_id);
        if ($comment && $comment->user_id === auth()->user()->id) {
            $comment->delete();
            //return redirect()->back()->with('success', 'ลบความคิดเห็นสำเร็จ.');
            return response()->json(['icon' => 'success', 'msg' => 'ลบความคิดเห็นสำเร็จ'], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

        } else {
            //  return redirect()->back()->with('error', 'Not Comment deleted.');
            return response()->json(['icon' => 'error', 'msg' => 'ไม่สามารถลบ Comment ได้'], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    //-------------------------------------edit-------------------------------------------

    public function getcommentid(Request $request, $id)
    {

        $comment = Comment::find($id);
        //dd($comment);
        if ($comment) {
            return response()->json(['result' => $comment], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

        }

    }

    public function edit(Comment $comment)
    {
        if ($comment && $comment->user_id === auth()->user()->id) {
            return view('comments.edit', compact('comment'));
        } else {

            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }
    }

    public function update(Request $request, Comment $comment)
    {
        //  dd($request->All());
        $this->validate($request, [
            'edit_comment' => 'required',
            'comment_id' => 'required',

        ]);


        $comment_id = isset($request->comment_id) ? $request->comment_id : '';
        $edit_comment = isset($request->edit_comment) ? $request->edit_comment : '';
        $user_imd = auth()->user()->id;
        // dd($user_imd);
        $check = Comment::where('id', '=', $comment_id)
            ->where('user_id', '=', $user_imd)->first();
        // dd($check);

        if ($check) {
            Comment::where('id', '=', $comment_id)
                ->where('user_id', '=', $user_imd)->update([
                        'comment' => $edit_comment
                    ]);

            return redirect()->back()->with('success', 'แก้ไขความคิดเห็นสำเร็จ.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

    }


    public function feedback($id)
    {
        $courses = Course::all();

        $comments = Comment::where('tutor_id', $id)->get();
        $commentCount = $comments->count();
        $RatingResults = number_format($comments->avg('rating'), 2);


        return view('coursesTutor.feedback', compact('comments', 'RatingResults', 'commentCount'));
    }



}