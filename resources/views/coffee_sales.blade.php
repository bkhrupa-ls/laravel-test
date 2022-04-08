@php
    /** @var \App\Models\Sale $sale */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
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

                    <div class="mb-6" x-data="initSalesForm()">
                        <form action="{{ route('sales.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-1 lg:gap-1">
                                <div class="flex">
                                <div class="w-full">
                                    <x-label for="formSalesProduct" :value="__('Product')" />

                                    <x-select id="formSalesProduct" class="block mt-1 w-full {{ $errors->has('product') ? 'border-red-600' : '' }}"
                                             name="product"
                                             :value="old('product')"
                                             :options="$choiceProducts"
                                             x-model="product"
                                             @change="getSellingPrice()"
                                             />
                                </div>
                                </div>
                                <div class="flex">
                                <div class="w-full">
                                    <x-label for="formSalesQuantity" :value="__('Quantity')" />

                                    <x-input id="formSalesQuantity" class="block mt-1 w-full {{ $errors->has('quantity') ? 'border-red-600' : '' }}"
                                             type="text"
                                             name="quantity"
                                             :value="old('quantity')"
                                             x-model="quantity"
                                             @keyup="getSellingPrice()"
                                             />
                                </div>
                                </div>
                                <div class="flex">
                                <div class="w-full">
                                    <x-label for="formSalesUnitCost" :value="__('Unit Cost (£)')" />

                                    <x-input id="formSalesUnitCost" class="block mt-1 w-full {{ $errors->has('unit_cost') ? 'border-red-600' : '' }}"
                                             type="text"
                                             name="unit_cost"
                                             :value="old('unit_cost')"
                                             x-model="unit_cost"
                                             @keyup="getSellingPrice()"
                                             />
                                </div>
                                </div>
                                <div class="flex">
                                <div class="w-full">
                                    <div class="block font-medium text-sm text-gray-700 mb-1">
                                        {{ __('Selling Price') }}
                                    </div>
                                    <div class="h-10 pt-2">
                                        <span x-text="selling_price"></span>
                                    </div>
                                </div>
                                </div>
                                <div class="flex">
                                <div class="w-full">
                                    <div class="block mb-1">&nbsp;</div>
                                    <x-button>
                                        {{ __('Record Sale') }}
                                    </x-button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <h1 class="text-5xl font-bold mt-0 mb-6">
                        {{ __('Previous sales') }}
                    </h1>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                        <tr>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Product') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Quantity') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Unit Cost') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Selling Price') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Sold at') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $sale)
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    @if ($sale->product)
                                                        {{ $sale->product->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $sale->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $sale->unit_cost->format() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $sale->selling_price->format() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ optional($sale->created_at)->format('Y-m-d H:i') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                    colspan="4">
                                                    {{ __('Sales not yet created.') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>{{ $sales->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
