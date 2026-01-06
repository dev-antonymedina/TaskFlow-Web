@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Editar Tarea</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Título</label>
        <input value="{{ $task->title }}" type="text" name="title" class="w-full border px-3 py-2 rounded mb-4">

        <label class="block mb-2">Descripción</label>
        <textarea name="description" class="w-full border px-3 py-2 rounded mb-4">{{ $task->description }}</textarea>

        <label class="block mb-2">Estado</label>
        <select name="status" class="w-full border px-3 py-2 rounded mb-4">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>En progreso</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completada</option>
        </select>

        <label class="block mb-2">Fecha límite</label>
        <input value="{{ $task->due_date }}" type="date" name="due_date" class="w-full border px-3 py-2 rounded mb-4">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>
    </form>
</div>
@endsection
