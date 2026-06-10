@extends('layouts.app')

@section('content')
<!-- Full beige background wrapper -->
<div class="bg-[#f8f1e7] min-h-screen">
    
    <div class="max-w-4xl mx-auto mt-6">
        <!-- Section header -->
        <div class="bg-[#6b4226] text-white p-4 rounded-t shadow">
            <h4 class="text-lg font-semibold">Customer Info</h4>
            <small class="text-gray-200">Add Your Information</small>
        </div>

        <!-- Form container -->
        <div class="bg-[#d2b48c] p-6 rounded-b shadow">
            <!-- Validation errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Name</label>
                        <input type="text" name="name" placeholder="Enter full name" required
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b4226]">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" placeholder="Enter email address" required
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b4226]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Phone</label>
                        <input type="text" name="phone" placeholder="Enter phone number" required
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b4226]">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Address</label>
                        <textarea name="address" rows="3" placeholder="Enter address" required
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b4226]"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-[#f8f1e7] border-[#6b4226] text-[#6b4226] rounded hover:bg-[#6b4226] hover:text-white">
                       Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-[#6b4226] text-white rounded hover:bg-[#5a3620]">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
