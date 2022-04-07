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


                    <div class="mb-6">
                        <form>
                            <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                                <div class="w-full px-2 md:w-1/4">
                                    <label class="block mb-1" for="formSalesQuantity">
                                        {{ __('Quantity') }}
                                    </label>
                                    <input class="w-full h-10 px-3 text-base border rounded focus:shadow-outline"
                                           type="text"
                                           id="formSalesQuantity"/>
                                </div>
                                <div class="w-full px-2 md:w-1/4">
                                    <label class="block mb-1" for="formSalesUnitCost">
                                        {{ __('Unit Cost (£)') }}
                                    </label>
                                    <input class="w-full h-10 px-3 text-base border rounded focus:shadow-outline"
                                           type="text" id="formSalesUnitCost"/>
                                </div>
                                <div class="w-full px-2 md:w-1/4">
                                    <div class="block mb-1">
                                        {{ __('Selling Price') }}
                                    </div>
                                    <div class="w-full h-10 px-3 text-base border rounded"></div>
                                </div>
                                <div class="w-full px-2 md:w-1/4">
                                    <div class="block mb-1">&nbsp;</div>
                                    <button
                                        class="w-full h-10 px-6 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        {{ __('Record Sale') }}
                                    </button>
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
                                                {{ __('Quantity') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Unit Cost') }}
                                            </th>
                                            <th class="px-6 py-4 text-left">
                                                {{ __('Selling Price') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $sale)
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $sale->quantity }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    £{{ $sale->unit_cost }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    £{{ $sale->selling_price }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                    colspan="3">
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
