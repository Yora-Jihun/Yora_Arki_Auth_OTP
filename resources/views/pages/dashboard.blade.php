<x-dashboard>
    <main class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-0.5">Welcome back, {{ auth()->user()->fullname ?? 'User' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-medium mb-1">Total Employees</p>
                <p class="text-2xl font-semibold text-gray-900">--</p>
            </div>
            <div class="bg-white p-6 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-medium mb-1">Present Today</p>
                <p class="text-2xl font-semibold text-gray-900">--</p>
            </div>
            <div class="bg-white p-6 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-medium mb-1">On Leave</p>
                <p class="text-2xl font-semibold text-gray-900">--</p>
            </div>
            <div class="bg-white p-6 border border-gray-100">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-medium mb-1">Pending Tasks</p>
                <p class="text-2xl font-semibold text-gray-900">--</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 border border-gray-100">
                <p class="text-sm font-semibold text-gray-900 mb-4">Activity Overview</p>
                <div class="h-48 flex items-center justify-center border-2 border-dashed border-gray-100 rounded-lg">
                    <span class="text-sm text-gray-400">Chart area ready for implementation</span>
                </div>
            </div>
            <div class="bg-white p-6 border border-gray-100">
                <p class="text-sm font-semibold text-gray-900 mb-4">Quick Actions</p>
                <div class="space-y-2">
                    <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 text-sm text-gray-700 transition">
                        + New Employee
                    </button>
                    <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 text-sm text-gray-700 transition">
                        + Mark Attendance
                    </button>
                    <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 text-sm text-gray-700 transition">
                        + Create Leave Request
                    </button>
                </div>
            </div>
        </div>
    </main>
</x-dashboard>