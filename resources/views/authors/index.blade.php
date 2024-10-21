<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="{{ route('authors.create') }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Add new Auhtors</a>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                @foreach ($authors as $author)
                <div class="flex flex-col p-6 mx-auto w-64 h-80 text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    @if ($author->image)
                        <img src="{{ asset('storage/'.$author->image) }}" alt="Author Image" class="w-full h-32 object-cover rounded-lg shadow-xl dark:shadow-gray-800">
                    @else
                        <img src="https://via.placeholder.com/100" alt="Default Image" class="w-full h-32 object-cover rounded-lg shadow-xl dark:shadow-gray-800">
                    @endif
                    <h3 class="mb-4 text-2xl font-semibold">{{ $author->name }}</h3>
                    <div class="py-3">
                        <a href="{{ route('authors.edit', $author->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-yellow-700">Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900" onclick="return confirm('Are you sure to Delete?')">Delete</button>
                        </form>
                    </div>
                </div>                
                @endforeach
            </div>
        </div>
    </div>
</x-layout>