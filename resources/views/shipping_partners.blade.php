@php
    /** @var \App\Models\ShipmentCost $shipmentCost */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set new shipment cost 🚚') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />


                    <div class="mb-6">
                        <form action="{{ route('shipment-cost.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="w-full mb-4">
                                <x-label for="ShipmentCostCost" :value="__('New cost of shipment')" />

                                <x-input id="ShipmentCostCost" class="block mt-1 w-full {{ $errors->has('cost') ? 'border-red-600' : '' }}"
                                         type="text"
                                         name="cost"
                                         :value="old('cost')"
                                />
                            </div>
                            <div class="w-full mb-4">
                                <x-button>
                                    {{ __('Set new price') }}
                                </x-button>
                            </div>
                        </form>
                    </div>

                    <h1 class="text-5xl font-bold mt-0 mb-6">
                        {{ __('Log of Shipment costs') }}
                    </h1>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                        <tr>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Shipment Cost') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Active') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Set at') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Numbers of sales') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($shipmentCosts as $shipmentCost)
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $shipmentCost->cost->format() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    @if($shipmentCost->is_active)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ optional($shipmentCost->created_at)->format('Y-m-d H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                     {{ $shipmentCost->sales_count }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                    colspan="4">
                                                    {{ __('Shipment costs not yet created.') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>{{ $shipmentCosts->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
