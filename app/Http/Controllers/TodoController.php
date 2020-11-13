<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complete_data = todo::all()->whereIn('work_complete', '1')->whereIn('delete_at', '')->sortByDesc("created_at"); //ดึงข้อมูลทั้งหมดจาก ฐานข้อมูล
        $unComplete_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->sortByDesc("created_at"); //ดึงข้อมูลทั้งหมดจาก ฐานข้อมูล
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count();
        return view('todo.select_todo', compact(['complete_data'], ['unComplete_data'], ['notify_data'])); //compact ไม่ต้องระบุ $ ให้ใส่ชื่อตัวแปรเพรียวได้ล้เย
        // return view('todo.select_todo', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count();
        return view('todo.insert_todo')->with('notify_data', $notify_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request); //เป็นเหมือนการ Debug ดูค่า
        //เช็คการป้อนข้อมูลจาก ฟิล input
        $request->validate([
            'todo_topic' => 'required',
            'todo_detail' => 'required',
            'todo_place' => 'required',
            'todo_date',
            'todo_alert'
        ]);
        //การบันทึกข้อมูล อ้างอิงกับ folder model/contact
        // todo::create($request->all());
        todo::create([
            'todo_topic' => $request['todo_topic'],
            'todo_detail' => $request['todo_detail'],
            'todo_place' => $request['todo_place'],
            'todo_alert' => $request['todo_alert'],
            'work_complete' => '0',
            'delete_at' => ''
        ]);
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count();
        //หลังจากบันทึกข้อมูลให้ redirect
        return redirect()->back()->with('message', 'Insert your Todo is ' . $request['todo_topic'] . ' complete.')->with('notify_data', $notify_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        todo::where('id', $id)->update(array('work_complete' => '1'));
        //หลังจากบันทึกข้อมูลให้ redirect
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count();
        return redirect()->back()->with('message', 'Todo ' . $request['todo_topic'] . ' is complete.')->with('notify_data', $notify_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $topic)
    {
        $delete_date = date('Y-m-d H:i:s');
        todo::where('id', $id)->update(array('delete_at' => $delete_date));
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count();
        return redirect()->back()->with('message', 'Delete todo ' . $topic . ' is complete.')->with('notify_data', $notify_data);
    }
    public function link_select()
    {
        return view('todo.select_todo');
    }
    // public function select_notify()
    // {
    //     $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count(); //ดึงข้อมูลทั้งหมดจาก ฐานข้อมูล
    //     return $notify_data;
    // }
}
