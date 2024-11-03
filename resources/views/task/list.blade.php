<table class="w-full text-sm text-left rtl:text-righ">
    <thead class="text-xsuppercase">
        <tr>
            <th scope="col" class="px-6 py-3">
                Title
            </th>
            <th scope="col" class="px-6 py-3">
                Description
            </th>
            <th scope="col" class="px-1 py-3">
                Due Date
            </th>
            <th scope="col" class="px-1 py-3">
                Done
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr class="hover:bg-gray-50">
            <td class="pl-6 py-4 w-0.5">
                {{ $task->title }}
            </td>
            <td class="px-6 py-4">
                {{ $task->description }}
            </td>
            <td class="px-6 py-4">
                {{ $task->due_date }}
            </td>
            <td class="px-6 py-4">
                @if ($task->done)
                    <svg class="h-8 w-8 text-green-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />  <polyline points="22 4 12 14.01 9 11.01" /></svg>
                @else
                    <svg class="h-8 w-8 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />  <line x1="9" y1="9" x2="15" y2="15" />  <line x1="15" y1="9" x2="9" y2="15" /></svg>
                @endif
            </td>
            <td class="px-6 py-4">
                <div class="flex flex-between">
                <div class="px-1">
                <form action="api/task/done" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 border border-purple-700 rounded" type="submit">
                        Done
                    </button>
                </form>
                </div>
                @if (in_array('edit task', $permitsAllowed) || in_array('is_admin', $permitsAllowed))
                    <div class="px-1 pt-2">
                        <a href="{{ route('task.edit', $task->id) }}" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none">Edit</a>
                    </div>
                @endif
                @if (in_array('delete task', $permitsAllowed) || in_array('is_admin', $permitsAllowed))
                    <div class="px-1">
                    <form action="api/task" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" type="submit">
                            Delete
                        </button>
                    </form>
                    </div>
                @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $tasks->links() }}
</div>
