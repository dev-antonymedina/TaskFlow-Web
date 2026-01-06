@extends('layouts.app')

@section('content')

<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Botón para crear nueva tarea -->
        <div class="mb-6 flex justify-end">
            <a href="{{ route('tasks.create') }}"
               class="px-3 py-2 bg-white text-black border border-gray-300 rounded-lg text-sm sm:text-base hover:bg-gray-100">
                + Nueva tarea
            </a>
        </div>

        <div class="bg-black text-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <h3 class="text-2xl font-bold mb-4">Mis tareas</h3>

            @if($tasks->isEmpty())
                <p class="text-gray-300">No tienes tareas registradas.</p>
            @else
                <div class="space-y-4">

                    @foreach ($tasks as $task)
                    <div class="p-4 bg-white text-black border rounded-lg flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

                        <!-- Info de la tarea -->
                        <div class="flex-1">
                            <h4 class="font-semibold text-lg">{{ $task->title }}</h4>
                            <p class="text-gray-700 text-sm sm:text-base">{{ $task->description }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Estado: <strong>{{ ucfirst($task->status) }}</strong>
                            </p>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-wrap gap-2 sm:gap-3">

                            <a href="{{ route('tasks.show', $task) }}"
                               class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm">
                                Ver
                            </a>

                            <a href="{{ route('tasks.edit', $task) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Editar
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Eliminar
                                </button>
                            </form>

                        </div>

                    </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
</div>

@endsection
