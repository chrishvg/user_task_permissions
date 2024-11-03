<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white">
@if(isset($errors) && $errors->any())
<div class="alert alert-success">
    @foreach ($errors->all() as $error)
        <strong>{{ $error }}</strong>
    @endforeach
</div>
@endif
@if(session('success'))
<div class="bg-green-500 text-white font-bold rounded-lg px-4 py-3" role="alert">
    <p>{{ session('success') }}</p>
</div>
@endif
@if (in_array('new task', $permitsAllowed) || in_array('is_admin', $permitsAllowed))
<form class="w-full -w-lg py-2" action="api/task" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="user_id" value="{{ $user->id }}">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Title
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title">
    </div>
    <div class="w-full md:w-1/3 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Description
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" type="text" name="description">
    </div>
    <div class="w-full md:w-1/3 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Due Date
        </label>
        <input id="due_date" name="due_date" type="date" class="bg-gray-200 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Select date" required>
    </div>
  </div>
  <div class="md:flex md:items-center pb-3">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Add New Task
    </button>
    </div>
  </div>
</form>
@endif
<div class="flex flex-wrap -mx-3 mb-12 container">
    <form id="searchForm" class="w-full mx-auto">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-2 pl-4">
                <select class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" name="completed" id="completed">
                    <option selected="">All</option>
                    <option value=1>Done</option>
                    <option value=0>Not Done</option>
                </select>
            </div>
            <div class="col-span-10">
                <label for="query" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="search" id="query" name="query" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500" placeholder="Title or Description" />
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="results">
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
</div>
</div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            const query = $('#query').val();
            const completed = $('#completed').val();
            console.log(completed);
            $.ajax({
                url: '/api/task/search',
                type: 'POST',
                data: {
                    query: query,
                    completed: completed,
                    user_id: '{{ Auth::user()->id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#results').html(response);
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#results').html('<div>An error occurred while searching.</div>');
                }
            });
        });
    });
</script>
