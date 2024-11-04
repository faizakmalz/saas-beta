@section('title', 'Tasks')
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{'Tasks - ' . strtoupper($projectName)}}
            </h2>
            <div class="flex gap-2">
                <x-primary-button  type="button" class="w-42">
                    <a href="{{ route('tasks.create', ['projectName' => $projectName, 'projectId' => $projectId]) }}">
                        Create Tasks
                    </a>
                </x-primary-button>
                <x-secondary-button type="button" class="w-42">
                    <a href="{{ route('projects.settings', ['projectId' => $projectId]) }}">
                        Settings
                    </a>
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <table class="min-w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                            <input type="checkbox" onclick="toggleAllCheckboxes(this)">
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                            Task Name
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                            Task Description
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                            Due Date
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            <input type="checkbox" name="task_ids[]" value="{{ $task->id }}">
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $task->task_name }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ $task->task_description }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm leading-5 text-gray-900">
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('d F Y') }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 text-sm leading-5 text-gray-900 flex gap-2">
                                            <x-primary-button  onclick="window.location='{{ route('tasks.edit', ['projectName' => $projectName, 'projectId' => $projectId, 'taskId' => $task->id]) }}'">Edit</x-primary-button>
                                            <form action="{{ route('tasks.delete', ['projectId' => $projectId, 'projectName' => $projectName, 'taskId' => $task->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                             <x-danger-button type="submit">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>   
            </div>
        </div>
    </div>
</x-app-layout>