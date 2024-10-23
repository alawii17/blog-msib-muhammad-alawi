<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="{{ route('categories.create') }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Add new Category</a>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                @foreach ($categories as $category)
                <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">{{ $category->name }}</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">{{ $category->description }}</p>
                    <div class="py-3">
                        <a href="{{ route('categories.edit', $category->slug) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-yellow-700">Edit</a>
                        <form action="{{ route('categories.destroy', $category->slug) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-red-900" onclick="return confirm('Are you sure to Delete?')">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</x-layout>