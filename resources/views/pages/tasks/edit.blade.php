@section('title', 'Edit Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tasks - ' . strtoupper($projectName) ) }}
        </h2>
    </x-slot>

    <div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('tasks.update', ['projectName' => $projectName, 'projectId' => $projectId, 'taskId' => $task->id] ) }}" method="POST" class="flex flex-col gap-8">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="task_name" :value="__('Task Name')" />
                                <x-text-input id="task_name" class="block mt-1 w-full" type="text" name="task_name" value="{{ $task->task_name }}" required />
                            </div>

                            <div>
                                <x-input-label for="task_description" :value="__('Task Description')" />
                                <x-text-input id="task_description" class="block mt-1 w-full" type="text" name="task_description" value="{{ $task->task_description }}" required  />
                            </div>

                            <div>
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" value="{{ $task->due_date }}" required  />
                            </div>

                            <x-primary-button type="submit" class="w-64 mt-8">
                                Update Task
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>