<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-0">
        @forelse ($posts as $post)
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
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
                </article>
                @empty
                <p class="text-center text-gray-500 dark:text-gray-400">No Posts avaible at the moment. Please check back later</p>
            </div>
            @endforelse
    </div>
</x-layout>
