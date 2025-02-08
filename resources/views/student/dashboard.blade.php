@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Student Information</h2>
                <a href="{{ route('student.profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit Profile</a>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Name</p>
                        <p class="text-lg font-semibold">{{ $student->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Student ID</p>
                        <p class="text-lg font-semibold">{{ $student->student_id ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Course</p>
                        <p class="text-lg font-semibold">{{ optional($student->course)->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Year Level</p>
                        <p class="text-lg font-semibold">{{ $student->year_level ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Section</p>
                        <p class="text-lg font-semibold">{{ optional($student->section)->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Attendance Rate</p>
                        <p class="text-lg font-semibold">{{ $attendanceRate ?? 0 }}%</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Recent Activities</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created By</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($activities as $activity)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $activity->title }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($activity->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $activity->due_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $activity->due_date->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ optional($activity->secretary)->name ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $activity->due_date->isPast() ? 'Overdue' : 'Pending';
                                        $statusColor = $activity->due_date->isPast() ? 'red' : 'yellow';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 dark:bg-{{ $statusColor }}-900 dark:text-{{ $statusColor }}-200">
                                        {{ $status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                    No activities found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($activities->hasPages())
                <div class="mt-4">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 