@section('title', 'Settings')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('projects.update', ['projectId' => $project->id]) }}" method="POST" class="flex flex-col gap-8">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $project->name }}" required />
                            </div>

                            <div>
                                <x-input-label for="duration" :value="__('Duration')" />
                                <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" value="{{ $project->duration }}" required  />
                            </div>

                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{ $project->start_date }}" required  />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{ $project->end_date }}" required  />
                            </div>
                            <div>
                                <x-primary-button type="submit" class="w-64 mt-8">
                                    Update Project
                                </x-primary-button>
                                
                            </div>    
                        </form>
                        <form action="{{ route('projects.delete', ['projectId'=> $project->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit" class="w-64 mt-3">
                                        Delete Project
                                    </x-danger-button>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>