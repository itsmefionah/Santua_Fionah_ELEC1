<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    
//Read
public function index() {
    $users = DB::select('select * from students order by id asc');
    return view('stud_view',['users'=>$users]);
 }

    public function insertform() {
        return view('stud_create');
     }
      //create
     public function insert(Request $request) {
        $name = $request->input('stud_name');
        DB::insert('insert into students (name) values(?)',[$name]);
        // echo "Record inserted successfully.<br/>";
        // echo '<a href = "/insert">Click Here</a> to go back.';
        return redirect()->route("home")->with(
         "Success","Added Successfully!"
        );
     }

      public function destroy($Id){
         DB::delete("delete from students where id = ?",[$Id]);
         return redirect()->route("home")->with(
            "Success","Deleted Successfully!"
           );
      }

      public function showEdit($id) {
         $users = DB::select('select * from students where id = ? order by id asc',[$id]);
         return view('stud_update',['users'=>$users]);
      }
   
      public function edit(Request $request,$id) {
         $name = $request->input('stud_name');
         DB::update('update students set name = ? where id = ?',[$name,$id]);
         return redirect()->route("home")->with(
            "Success","Updated Successfully!"
           );
      }
   
}
