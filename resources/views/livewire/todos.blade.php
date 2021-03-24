<div class="container my-5">
    <form class="form-inline" wire:submit.prevent="{{$edit_mode ? "updateTodo": "addTodo"}}">
        <div class="form-group">
            <p style="color:red">{{$validation_message}}</p>
            <label for="todo-text">Something to do</label>
            <input class="form-control mx-4" id="todo-text" autofocus type="text" wire:model="todo_text" required />
            <button class="btn btn-primary justify-self-right" type="submit">{{$edit_mode ? "Update": "Add"}}</button>
        </div>
    </form>

    <div>
        <div class="d-flex align-items-baseline">
            <p>Filters</p>

            <div class="btn-group my-4 ml-3" role="group" aria-label="Basic example">
                <button wire:click="setActiveFilter('undone')" type="button" aria-pressed="true" class="btn btn-sm btn-outline-secondary {{$active_filter === 'undone' ? 'active': ''}}">Undone</button>
                <button wire:click="setActiveFilter('done')" type="button" aria-pressed="false" class="btn btn-sm btn-outline-secondary {{$active_filter === 'done' ? 'active': ''}}">Done</button>
                <button wire:click=" setActiveFilter('all')" type="button" aria-pressed="false" class="btn btn-sm btn-outline-secondary {{$active_filter === 'all' ? 'active': ''}}">All</button>
            </div>
        </div>

        @foreach($todos as $todo)
        <div class=" d-flex align-items-baseline my-2">
            <input {{ $todo->is_done ? "checked":  "" }} wire:change="setAsDone({{$todo->id}})" type="checkbox" />
            <p class="mx-4 {{$todo->is_done ? "strikethrough":  ""}}">{{$todo->todo_text}}</p>

            <div class="d-flex justify-content-between align-items-center">
                <button class="icon-button">
                    <img src="/icons/edit-icon.svg" alt="edit todo" class="mr-2" style="width:15px; cursor: pointer" wire:click="setEditMode({{$todo->id}})">
                </button>
                <button wire:click="removeTodo({{$todo->id}})" type="button" class="close text-danger" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endforeach

        @if(!count($todos))
        <p>Nothing to do</p>
        @endif
    </div>
</div>
