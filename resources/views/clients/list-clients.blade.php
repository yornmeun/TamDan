<x-filament-panels::page>
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($clients as $client)
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition overflow-hidden">
            <div class="p-6">

                {{-- Header --}}
                <div class="flex items-start justify-between">

                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 font-bold text-lg">
                            {{ strtoupper(substr($client->name, 0, 2)) }}
                        </div>

                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">
                                {{ $client->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $client->company_name ?: 'Individual' }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2">

                        {{-- View --}}
                        <a
                            href="{{ route('filament.admin.resources.clients.view', $client) }}"
                            class="rounded-lg p-2 bg-gray-100 text-primary-600"
                            title="View">
                            <x-heroicon-o-eye class="h-5 w-5" />
                        </a>

                        {{-- Edit --}}
                        <a
                            href="{{ route('filament.admin.resources.clients.edit', $client) }}"
                            class="rounded-lg p-2 bg-blue-100 text-blue-600"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="h-5 w-5" />
                        </a>

                        {{-- Delete --}}
                        {{ ($this->deleteAction)(['client' => $client->getKey()]) }}

                    </div>

                </div>

                {{-- Contact --}}
                <div class="mt-5 space-y-2 text-sm text-gray-600">

                    <div class="flex items-center gap-2">
                        <x-heroicon-o-envelope class="h-4 w-4" />
                        {{ $client->email }}
                    </div>

                    <div class="flex items-center gap-2">
                        <x-heroicon-o-phone class="h-4 w-4" />
                        {{ $client->phone }}
                    </div>

                    <div class="flex items-center gap-2">
                        <x-heroicon-o-map-pin class="h-4 w-4" />
                        {{ $client->address }}
                    </div>

                </div>

                <div class="my-5 border-t"></div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs uppercase text-gray-500">{{__('project.project')}}</p>
                        <p class="text-xl font-bold">{{ $client->projects_count }}</p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">{{ __('client.revenue') }}</p>
                        <p class="text-xl font-bold">${{ number_format($client->invoices_sum_paid_amount ?? 0) }}</p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">{{ __('client.owing') }}</p>
                        <p class="text-xl font-bold text-orange-500">
                            ${{ number_format($client->invoices_sum_due_amount ?? 0) }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
<x-filament::pagination
    :paginator="$clients"
    :page-options="[5, 10, 20, 50, 100, 'all']"
    current-page-option-property="perPage"
/>

<x-filament-actions::modals />
</x-filament-panels::page>
