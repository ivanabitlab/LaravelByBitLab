    @if(Route::currentRouteName() == 'categories.show' )
    <header class="max-w-5xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Kategorija <span class="text-blue-500">{{$category->title}}</span>
        </h1>
        <p class="text-sm mt-14">
            {{$category->description}}
        </p>
    @elseif(Route::currentRouteName() == 'users.show' )
    <header class="max-w-xl mx-auto mt-20 text-center">
            <h1 class="text-4xl">
                Autor <span class="text-blue-500">{{$user->username}}</span>
            </h1>
            <p class="text-sm mt-14">
                {{$user->name}} je sa nama od <time>{{ date('d.m.Y', strtotime($user->created_at)) }}</time>. Pročitajte njegove člane na blogu!
            </p>
    @else
        <header class="max-w-xl mx-auto mt-20 text-center">
            <h1 class="text-4xl">
                Kurs <span class="text-blue-500">Laravela</span>
            </h1>

            <h2 class="inline-flex mt-2">By BitLab <img src="/images/lary-head.svg" alt="Head of Lary the mascot"></h2>

            <p class="text-sm mt-14">
                Spisak svih kurseva u organizaciji BitLab-a možete pogledati <a class="text-blue-500" href="https://edu.bitlab.rs/lat/index.php">ovde</a>!
            </p>
    @endif

            <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
                <!--  Category -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                    <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold" onchange="if (this.value) window.location.href=this.value">
                        <option value="category" disabled selected>Kategorija
                        </option>
                        @foreach($categories as $category)
                        <option value="/categories/{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>

                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22" height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path fill="#222" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>
                </div>

                <!-- Other Filters -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                    <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold" onchange="if (this.value) window.location.href=this.value">
                        <option value="author" disabled selected>Autor
                        </option>
                        @foreach($authors as $author)
                        <option value="/users/{{$author->id}}">{{$author->username}}</option>
                        @endforeach
                    </select>

                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22" height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path fill="#222" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>
                </div>

                <!-- Search -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                    <form method="GET" action="#">
                        <input type="text" name="search" placeholder="Find something" class="bg-transparent placeholder-black font-semibold text-sm">
                    </form>
                </div>
            </div>
        </header>