<div class="container">
    <form wire:submit.prevent="addTodo">
        <p style="color:red">{{$validation_message}}</p>
        <input autofocus type="text" wire:model="todo_text" />
        <button type="submit">Add</button>
    </form>
    <div>
        @foreach($todos as $todo)
        <div class="d-flex align-items-baseline my-2">
            @if($todo->is_done)
            <s>
                <p class="mx-4 d-inline">{{$todo->todo_text}}</p>
            </s>
            <input checked value="$todo->is_done" wire:change="setAsDone({{$todo->id}})" type="checkbox" />
            @else
            <p class="mx-4">{{$todo->todo_text}}</p>
            <input value="$todo->is_done" wire:change="setAsDone({{$todo->id}})" type="checkbox" />
            @endif
        </div>
        <div>
            <button wire:click="removeTodo($todo->id)">X</button>
        </div>
    </div>
    @endforeach
</div>
</div>
