<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white">
<form class="w-full -w-lg" action="/api/task" method="POST">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $task->id }}">
    <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Title
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title" value="{{$task->title}}">
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Description
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" type="text" name="description" value="{{$task->description}}">
    </div>
    <div class="w-full md:w-1/3 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Due Date
        </label>
        <input id="due_date" name="due_date" type="date" class="bg-gray-200 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Select date" value="{{$task->due_date}}">
    </div>
  </div>
  <div class="md:flex md:items-center pb-3">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Edit Task
      </button>
    </div>
  </div>
</form>
</div>
</x-app-layout>
