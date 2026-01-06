@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6 px-4 sm:px-0">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
            Mis Tareas
        </h1>
    </div>

    <div class="mb-6 sm:flex sm:justify-between sm:items-center"> 
                    <a href="{{ route('tasks.create') }}"
            class="text-white px-4 py-2 rounded border-2 border-black text-center text-sm sm:text-base"
            style="background-color: #630000;">
            Crear Tarea
        </a>
                    <a href="{{ route('tasks.completed') }}"
            class="text-white px-4 py-2 rounded border-2 border-black text-center text-sm sm:text-base"
            style="background-color: #630000;">
            Tareas completadas
        </a>
    </div>


    <!-- Mensaje de éxito -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm sm:text-base">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabla: SOLO desktop -->
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
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600">Editar</a>

                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="text-green-600"
                                    onclick="return confirm('¿Desea marcar como completada la tarea?')">
                                    Completar
                                </button>
                            </form>

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

    <!-- Cards: SOLO mobile
    <div class="md:hidden">


        <div class="space-y-4 md:hidden">
            @foreach ($tasks as $task)
            <div class="bg-white border rounded-lg p-4 shadow-sm">

                <h3 class="font-semibold text-lg text-gray-900">
                    {{ $task->title }}
                </h3>

                <p class="text-sm text-gray-600 mt-1">
                    Estado:
                    <span class="ml-1 px-2 py-0.5 text-xs rounded {{ $task->status_color }}">
                        {{ $task->status_label }}
                    </span>
                </p>

                <p class="text-sm text-gray-600 mt-1">
                    Fecha límite:
                    <strong>{{ $task->due_date ?? 'Sin fecha' }}</strong>
                </p>

                <div class="flex gap-4 mt-3 text-sm">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600">
                        Editar
                    </a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600"
                            onclick="return confirm('¿Eliminar tarea?')">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div> -->

</div>
@endsection