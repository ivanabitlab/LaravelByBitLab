<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        @include('blog.nav')
        @include('blog.header')
        @if($posts->onFirstPage())
        @include('blog.landing')
        @else
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <div class="lg:grid lg:grid-cols-3">
                @foreach($posts as $key => $post)
                <article class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
                    <div class="py-6 px-5">
                        <div>
                            <img src="{{ asset("storage/".$post->featured_image) }}" alt="Blog Post illustration" class="rounded-xl">
                        </div>

                        <div class="mt-8 flex flex-col justify-between">
                            <header>
                                <div class="space-x-2">
                                    @foreach($post->categories as $category)
                                    <a href="/categories/{{$category->id}}" class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold" style="font-size: 10px">{{$category->title}}</a>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <h1 class="text-3xl">
                                        {{$post->title}}
                                    </h1>

                                    <span class="mt-2 block text-gray-400 text-xs">
                                        Objavljeno <time>{{ date('d-m-Y H:i:s', strtotime($post->published_at)) }}</time>
                                    </span>
                                </div>
                            </header>

                            <p class="text-sm mt-4 overflow-hidden h-32">
                                {{substr($post->body, 0, 300)}}...
                            </p>

                            <footer class="flex justify-between items-center mt-8">
                                <div class="flex items-center text-sm">
                                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                                    <div class="ml-3">
                                        <h5 class="font-bold"><a href="/users/{{$post->user->id}}">{{$post->user->username}}</a></h5>
                                        <h6>Autor članka</h6>
                                    </div>
                                </div>

                                <div>
                                    <a href="/posts/{{$post->id}}" class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">Pročitaj više</a>
                                </div>
                            </footer>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            {{ $posts->links() }}
        </main>
        @endif
        @include('blog.footer')
    </section>
</body>