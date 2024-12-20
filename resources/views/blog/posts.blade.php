<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="{{ route('posts.create') }}"
        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Create
        New Post</a>
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-0">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <a href="/categories/{{ $post->category->slug }}">
                            <span
                                class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                {{ $post->category->name }}
                            </span>
                        </a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" alt="Author Image"
                            class="w-full h-40 object-cover rounded-lg shadow-xl dark:shadow-gray-800">
                    @else
                        <img src="https://via.placeholder.com/400x200" alt="Default Image"
                            class="w-full h-32 object-cover rounded-lg shadow-xl dark:shadow-gray-800">
                    @endif
                    <a href="/posts/{{ $post->slug }}" class="hover:underline">
                        <h2 class="mb-2 mt-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}</h2>
                    </a>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($post->body, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $post->author->image) }}"
                                alt="{{ $post->author->name }}" />
                            <a href="/authors/{{ $post->author->username }}">
                                <span class="font-medium text-sm dark:text-white">
                                    {{ $post->author->name }}
                                </span>
                            </a>
                        </div>
                        <a href="/posts/{{ $post['slug'] }}"
                            class="inline-flex items-center font-medium text-sm text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="py-3">
                        <a href="{{ route('posts.edit', $post->slug) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-yellow-700">Edit</a>
                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900" onclick="return confirm('Are you sure to Delete?')">Delete</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-layout>
