<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = news::all();
        return view('news.index', [
            'news' => $news
        ]);

    }

    public function edit(news $news)
    {
        return view('news.edit', compact('news'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'news_title' => 'required',
            'news_detail' => 'required',
            'news_tel' => 'required|min:10',
            'news_img' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120'
        ]);

        $imagePath = $request->file('news_img')->store('news', 'public');

        $news = new news;
        $news->news_img = $imagePath;

        $news->news_title = $request->news_title;
        $news->news_detail = $request->news_detail;
        $news->news_tel = $request->news_tel;
        $news->news_status = '0';

        $news->save();

        return redirect()->route('news.index')->with('News', 'เพิ่มข่าวสำเร็จแล้วสิ้น.');
    }

    public function update(Request $request, $news_id)
    {
        $request->validate([
            'news_img' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'news_title' => 'required',
            'news_detail' => 'required',
            'news_tel' => 'required'
        ]);

        $imagePath = $request->file('news_img')->store('news', 'public');

        $news = news::find($news_id);

        $news->news_img = $imagePath;
        ;
        $news->news_title = $request->news_title;
        $news->news_detail = $request->news_detail;
        $news->news_tel = $request->news_tel;
        $news->save();

        return redirect()->route('news.index')->with('success', 'แก้ไขข่าวสำเร็จแล้ว.');
    }

    public function destroy(news $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'ลบข่าวสำเร็จแล้ว');
    }


}