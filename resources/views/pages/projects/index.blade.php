@section('title', 'Projects2')
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <x-primary-button  type="button" class="w-42">
                <a href="{{ route('projects.create') }}">
                    Create Project
                </a>
            </x-primary-button>
        </div>
    </x-slot>

    <div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-wrap">
                        @foreach ($projects as $project)
                            <a href="{{ route('tasks.index', ['projectId' => $project->id, 'projectName' => $project->name]) }}">
                                <div class="w-64 p-6 flex gap-2 flex-col items-center rounded-lg shadow-md m-4">
                                    <div class="uppercase text-lg font-bold">{{ $project->name }}</div>
                                    <div class="border border-bottom border-[#2044b4] w-full rounded"></div>
                                    <div class="text-[10px]">
                                        {{ \Carbon\Carbon::parse($project->start_date)->format('d F Y') }} - 
                                        {{ \Carbon\Carbon::parse($project->end_date)->format('d F Y') }}
                                    </div>
                                    <!-- <div>
                                        {{ asset('/img/Group 3.png') }}
                                    </div> -->
                                </div>
                            </a>
                        @endforeach
                    </div>  
                </div>

                <div class="mt-8">
                        <div class="text-sm font-medium text-gray-700 mb-2">Projects Created ({{ $projects->count() }}/20)</div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-blue-500 h-4 progress-bar-animation" 
                            style="--bar-width: {{ min(($projects->count() / 20) * 100, 100) }}%;">
                        </div>

                        </div>
                    </div>
            </div>   
        </div>
    </div>

    <!-- Progress Bar -->
    
</x-app-layout>