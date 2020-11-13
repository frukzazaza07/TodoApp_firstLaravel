<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    public $table = "my_todo";
    use HasFactory;
    //column ในตารางของฐานข้อมูล
    protected $fillable = [
        'todo_topic',
        'todo_detail',
        'todo_place',
        'todo_alert',
        'work_complete',
        'delete_at',
        'created_at'
    ];
    public function select_notify()
    {
        $notify_data = todo::all()->whereNotIn('work_complete', '1')->whereIn('delete_at', '')->count(); //ดึงข้อมูลทั้งหมดจาก ฐานข้อมูล
        return $notify_data;
    }
}
