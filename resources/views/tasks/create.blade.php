@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4 text-black">Crear Tarea</h1>

    <form id="taskForm" action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Título</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full border px-3 py-2 rounded mb-1">
        @error('title')
        <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
        @enderror

        <label class="block mb-2">Descripción</label>
        <textarea name="description" class="w-full border px-3 py-2 rounded mb-1">{{ old('description') }}</textarea>
        @error('description')
        <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
        @enderror

        <label class="block mb-2">Fecha límite</label>
        <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}"
            class="w-full border px-3 py-2 rounded mb-1">
        <p id="due_date_error" class="text-red-600 text-sm mb-2" style="display:none;"></p>
        @error('due_date')
        <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
        @enderror

        <div class="mt-4">
            <button id="submitBtn" class="btn">
                Guardar
            </button>

            <a href="{{ route('tasks.index') }}" class="btn">
                Volver a la lista de tareas</a>
        </div>

    </form>
</div>


<script>
    (function() {
        // Toast notification system
        function showToast(message, type = 'error') {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'toast-container';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        const form = document.getElementById('taskForm');
        const titleInput = document.querySelector('input[name="title"]');
        const descriptionInput = document.querySelector('textarea[name="description"]');
        const dueDateInput = document.getElementById('due_date');
        const errorEl = document.getElementById('due_date_error');

        const minDate = new Date('2025-01-01'); // controller uses after:2025-01-01 (must be > this date)
        const maxDate = new Date('2100-01-01'); // controller uses before:2100-01-01 (must be < this date)

        function validateDueDate() {
            const val = dueDateInput.value;
            if (!val) {
                errorEl.style.display = 'none';
                errorEl.textContent = '';
                return true; // nullable field
            }
            const d = new Date(val + 'T00:00:00');
            if (isNaN(d.getTime())) {
                showToast('La fecha no es válida.', 'error');
                return false;
            }
            if (d <= minDate) {
                showToast('La fecha debe ser posterior a 2025-01-01.', 'error');
                return false;
            }
            if (d >= maxDate) {
                showToast('La fecha debe ser anterior a 2100-01-01.', 'error');
                return false;
            }
            errorEl.style.display = 'none';
            errorEl.textContent = '';
            return true;
        }

        function validateForm() {
            const title = titleInput.value.trim();
            const description = descriptionInput.value.trim();

            if (!title) {
                showToast('Por favor, ingresa un título para la tarea.', 'error');
                titleInput.focus();
                return false;
            }

            if (!description) {
                showToast('Por favor, ingresa una descripción para la tarea.', 'error');
                descriptionInput.focus();
                return false;
            }

            if (!validateDueDate()) {
                showToast('Por favor, verifica la fecha límite de la tarea.', 'error');
                dueDateInput.focus();
                return false;
            }

            return true;
        }

        dueDateInput.addEventListener('change', validateDueDate);
        dueDateInput.addEventListener('input', validateDueDate);

        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    })();
</script>
@endsection