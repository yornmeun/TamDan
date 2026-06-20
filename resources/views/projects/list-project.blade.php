@php
    $projects = $records ?? $projects;
@endphp

<div class="grid gap-6
            sm:grid-cols-1
            md:grid-cols-2
            xl:grid-cols-3">

    @foreach($projects as $project)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg transition p-6">
            <div class="flex justify-between items-start">
                    <span
                        class="inline-flex rounded-full border border-blue-500 text-blue-600 text-xs font-medium px-3 py-1">
                        {{ $project->title ?? 'Web Development' }}
                    </span>

                    <span class="rounded-full px-3 py-1 text-xs font-medium {{ $project->getStatusColorAttribute($project->status) }}">
                        {{ $project->getProjectStatusAttribute($project->status) }}
                    </span>
            </div>

            {{-- Title --}}
            <h2 class="mt-5 text-xl font-bold text-gray-900">
                {{ $project->title }}
            </h2>

            <p class="text-gray-500">
                {{ $project->client->name }}
            </p>

            {{-- Progress --}}
            <div class="flex justify-between mt-6 mb-2">
                    <span class="text-gray-500 text-sm">
                        {{ $project->getProjectStatusAttribute($project->status) }}
                    </span>
                <span class="font-bold">
                        {{ $project->getProgressAttribute() }}%
                    </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div
                    class="bg-sky-500 h-2 rounded-full transition-all duration-500"
                    style="width: {{ $project->getProgressAttribute() }}%;">
                </div>
            </div>

            {{-- Info --}}
            <div class="grid grid-cols-2 gap-3 mt-6">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs uppercase tracking-wide text-gray-400">
                        {{ __('project.duration') }}
                    </p>
                    <p class="font-semibold mt-1 text-sm">
                        {{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d-M-Y') }}
                        -
                        {{ \Carbon\Carbon::parse($project->due_date)->translatedFormat('d-M-Y') }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-400">
                        {{ __('project.tasks') }}
                    </p>
                    <p class="font-semibold mt-1">
                        {{ $project->tasks()->where('status','done')->count() }}
                        /
                        {{ $project->tasks()->count() }}
                    </p>
                </div>
            </div>

            {{-- Description --}}
            {{-- @if($project->description)
                    <p class="mt-5 text-sm text-gray-500 line-clamp-2">
                        {{ $project->description }}
                    </p>
                @endif --}}

            {{-- Actions --}}
            <div class="flex justify-end gap-2 mt-6">
                <a
                    href="{{ route('filament.admin.resources.projects.view', $project) }}"
                    class="rounded-lg p-2 bg-gray-100 text-primary-600"
                    title="View">
                    <x-heroicon-o-eye class="h-5 w-5" />
                </a>
                <a
                    href="{{ route('filament.admin.resources.projects.edit', $project) }}"
                    class="rounded-lg p-2 bg-blue-100 text-blue-600"
                    title="Edit">
                    <x-heroicon-o-pencil-square class="h-5 w-5" />
                </a>
                {{ ($this->deleteAction)(['project' => $project->getKey()]) }}

            </div>
        </div>

    @endforeach
</div>

<x-filament-actions::modals />
