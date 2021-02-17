<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo;

class Todos extends Component
{
    public $todo_text;
    public $edit_mode;
    public $validation_message = "";
    public $edited_todo_id = 0;
    public $active_filter = "undone";

    protected $rules = [
        'todo.todo_text' => 'required'
    ];

    public function getTodos()
    {
        switch ($this->active_filter) {
            case "done":
                return Todo::where('is_done', true)->get();
            case "undone":
                return Todo::where('is_done', false)->get();
            case "all":
                return Todo::all();
            default:
                return Todo::all();
        }
    }

    public function addTodo()
    {
        if ($this->todo_text === "") {
            $this->validation_message = "Please type a todo";
            return;
        }
        $this->validation_message = "";

        Todo::create(["todo_text" => $this->todo_text, "is_done" => false]);
        $this->todo_text = "";
    }

    public function setAsDone($id)
    {
        $todo = Todo::find($id);
        $todo->is_done = !$todo->is_done;
        $todo->save();
    }

    public function setEditMode($id)
    {
        $todo = Todo::find($id);
        $this->edit_mode = true;
        $this->todo_text = $todo->todo_text;
        $this->edited_todo_id = $todo->id;
    }

    public function updateTodo()
    {
        $todo = Todo::find($this->edited_todo_id);
        $todo->todo_text = $this->todo_text;
        $todo->save();
        $this->edit_mode = false;
        $this->todo_text = "";
    }

    public function removeTodo($id)
    {
        $todo = Todo::find($id);
        $todo->forceDelete();
    }

    public function setActiveFilter($filter)
    {
        $this->active_filter = $filter;
    }

    public function render()
    {
        return view('livewire.todos', ["todos" => $this->getTodos()]);
    }
}
