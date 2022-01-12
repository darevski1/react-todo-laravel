<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function create(Request $request){
        
        $request->validate([
            "title" => "required|max:255",
            "description" => "required"
        ]);

        $todos = new Todos();
        $todos->title = $request->title;
        $todos->description = $request->description;
        $todos->user_id = $request->user_id;
        $todos->save();

        return $todos;
    }

    // get all
    public function all(){
        $todo =  Todos::all();
        return $todo;
    }
    // Get by status and by user
    public function getbyStatus($status, $id){
        $todo = Todos::where(['status' => $status, 'user_id' => $id])->get();
        return $todo;
         
    }
    // get all by user
    public function getbyUserId($id){
        $todo = Todos::where(['user_id' => $id])->get();
        return $todo;
    }

    public function update(Request $request, $id){   

        $request->validate([
            "title" => "required|max:255",
            "description" => "required"
        ]);

        $todo = Todos::find($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();
        return $todo;
    }
    public function delete($id)
    {
        $todo = Todos::find($id);
        $todo->delete();

        if($todo){
            return "Success";
        }  
    }

    public function closeTodo($id){
        $todo = Todos::find($id);
        $todo->status = 1;
        $todo->save();
        if($todo){
            return "Success";
        }  
    }
  
}
