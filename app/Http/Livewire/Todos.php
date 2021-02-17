<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo;

class Todos extends Component
{
    public $todo_text;
    public $validation_message = "";

    protected $rules = [
        'todo.todo_text' => 'required'
    ];


    public function todos()
    {
        return Todo::all();
    }

    public function addTodo()
    {
        if ($this->todo_text === "") {
            $this->validation_message = "Please type a todo";
            return;
        }
        $this->validation_message = "";

        Todo::create(["todo_text" => $this->todo_text, "is_done" => false]);
    }

    public function setAsDone($id)
    {
        $todo = Todo::find($id);
        $todo->is_done = !$todo->is_done;
        $todo->save();
    }

    public function render()
    {
        return view('livewire.todos', ["todos" => $this->todos()]);
    }
}
