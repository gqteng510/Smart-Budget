@extends('layouts.app')

@section('content')
<div class="bg-[#f8f1e7] min-h-screen">
    <div class="max-w-5xl mx-auto mt-6">
        <!-- Header -->
        <div class="bg-[#6b4226] text-white p-4 rounded-t shadow flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold">Customer List</h2>
                <small class="text-gray-200">View Customers' Information</small>
            </div>
        </div>

        <!-- Success message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table container -->
        <div class="bg-[#d2b48c] p-6 rounded-b shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-[#6b4226] text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Phone</th>
                        <th class="px-4 py-2 text-left">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="bg-white border-b border-gray-300">
                            <td class="px-4 py-2">{{ $customer->name }}</td>
                            <td class="px-4 py-2">{{ $customer->email }}</td>
                            <td class="px-4 py-2">{{ $customer->phone }}</td>
                            <td class="px-4 py-2">{{ $customer->address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                No customers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
