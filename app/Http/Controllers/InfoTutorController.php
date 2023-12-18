<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\InfoTutor;
use DB;


class InfoTutorController extends Controller
{
    

    // หน้าโชว์ข้อมูลหน้า tutor ขอฝัง admin
    public function index() {
        $InfoTutor = InfoTutor::all();
        return view('tutor.index', [
            'InfoTutor' => $InfoTutor
        ]);
        
    }

    // หน้าโชว์ข้อมูลหน้า tutor ขอฝัง user 
    // public function indexuser()
    // {
    //     $tutor_datas = InfoTutor::all();
    //     return view('Tutors.indexuser', ['info_tutors' => $tutor_datas]);
    // }


    
/////// แก้ไขข้อมูล //////////////
    public function edit(InfoTutor $InfoTutor)
    {
        return view('InfoTutor.edit', compact('InfoTutor'));
    }
    public function update(Request $request, $Info_id)
    {
        $InfoTutor = InfoTutor::where('Info_id', $Info_id)
            ->update([
                'info_tutor_education' => $request->input('info_tutor_education'),
                'info_tutor_faculty' => $request->input('info_tutor_faculty'),
                'info_tutor_major' => $request->input('info_tutor_major'),
                'info_tutor_grade' => $request->input('info_tutor_grade'),
                'info_tutor_univercity' => $request->input('info_tutor_univercity'),
                'info_tutor_location' => $request->input('info_tutor_location'),
                'info_tutor_exp' => $request->input('info_tutor_exp'),
                // 'tutor_id' => $request->tutor_id
            ]);

        return redirect('admin/InfoTutor');
     }

    
////////////// ลบ ///////////
    public function destroy(InfoTutor $InfoTutor)
    {
        $InfoTutor->delete();
        return redirect()->route('InfoTutor.index')->with('success', 'ลบประวัติติวเตอร์สำเร็จแล้ว.');

    }

   
    
}


