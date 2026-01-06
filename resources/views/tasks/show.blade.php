@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <a href="{{ route('tasks.index') }}" 
           class="text-blue-600 hover:underline">
            ← Volver a las tareas
        </a>

        <div class="bg-grey-100 shadow rounded-lg p-6 mt-4">
            <h1 class="text-3xl font-bold mb-4">{{ $task->title }}</h1>

            @if ($task->description)
                <p class="text-gray-700 mb-4">
                    {{ $task->description }}
                </p>
            @endif

            <div class="flex items-center gap-4 mb-4">
                <span class="px-3 py-1 rounded-full text-sm 
                    {{ $task->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                    {{ ucfirst($task->status) }}
                </span>

                @if($task->due_date)
                    <span class="text-gray-600 text-sm">
                        Fecha límite: <strong>{{ $task->due_date }}</strong>
                    </span>
                @endif
            </div>

            <div class="flex items-center gap-4 mt-6">
                <a href="{{ route('tasks.edit', $task) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Editar
                </a>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
