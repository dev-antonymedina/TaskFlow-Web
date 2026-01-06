@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6 px-4 sm:px-0">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
            Tareas Completadas
        </h1>
    </div>

    <div class="mb-6 sm:flex sm:justify-between sm:items-center"> 
        <a href="{{ route('tasks.index') }}"
            class="text-white px-4 py-2 rounded border-2 border-black text-center text-sm sm:text-base"
            style="background-color: #630000;">
            Volver a Mis Tareas
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm sm:text-base">
        {{ session('success') }}
    </div>
    @endif

    <div class=" md:block">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b-2 border-gray-300">
                        <th class="py-3 px-4 font-semibold text-gray-700">Título</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Estado</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Fecha límite</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $task->title }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-sm font-medium rounded {{ $task->status_color }}">
                                {{ $task->status_label }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $task->due_date ?? 'Sin fecha' }}</td>
                        <td class="py-3 px-4 flex gap-3">
                            <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600">Ver</a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600"
                                    onclick="return confirm('¿Eliminar tarea?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
