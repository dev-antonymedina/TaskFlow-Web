<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Mostrar todas las tareas del usuario autenticado
    public function index()
    {
        // Mostrar solo tareas que NO están completadas
        $tasks = Auth::user()->tasks()->where('status', '!=', 'completed')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    // Mostrar tareas completadas
    public function completed()
    {
        $tasks = Auth::user()->tasks()->where('status', 'completed')->latest()->get();
        return view('tasks.completed', compact('tasks'));
    }

    // Marcar una tarea como completada
    public function complete(Task $task)
    {
        $this->authorizeTask($task);

        $task->update(['status' => 'completed']);

        return redirect()->route('tasks.index')->with('success', 'Tarea marcada como completada');
    }

    // Mostrar formulario para crear nueva tarea
    public function create()
    {
        return view('tasks.create');
    }

    // Guardar la tarea en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'due_date' => 'nullable|date|before:2100-01-01|after:2025-01-01',
            'status' => 'nullable|in:pending,completed',
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente');
    }

    // Mostrar una tarea
    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    // Editar una tarea
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    // Actualizar tarea
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'due_date' => 'nullable|date|before:2100-01-01|after:2025-01-01',
            'status' => 'nullable|in:pending,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente');
    }

    // Eliminar tarea
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente');
    }

    // Asegurar que la tarea pertenece al usuario autenticado
    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a esta tarea');
        }
    }
}
