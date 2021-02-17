<div class="container">
    <form wire:submit.prevent="save">
        {{-- <p style="color:red">{{$validation_message}}</p> --}}
        <input autofocus type="text" wire:model="todo.todo_text" />
        <button type="submit">Add</button>
    </form>
    <div>
        {{--
        @foreach($todos as $todo)
        <form wire:submit.prevent="save" class="d-flex align-items-baseline my-2">
            <div class="d-flex align-items-baseline">
                <input wire:model="todo.is_done" type="checkbox" />
                <p class="mx-4">{{$todo->todo_text}}</p>
    </div>
    <div>
        <button wire:click="removeTodo">X</button>
    </div>
    </form>
    @endforeach
    --}}
</div>
</div>
