<nav class="md:flex md:justify-between md:items-center">
    <div class="bg-blue-500">
        <a href="/">
            <img src="/images/logo.png" alt="Laracasts Logo" width="165">
        </a>
    </div>
    @guest
    <div class="mt-8 md:mt-0">
        <a href="/registration" class="text-xs font-bold uppercase">Registruj se</a>

        <a href="/login" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
            Uloguj se
        </a>
    </div>
    @else
    <div class="mt-8 md:mt-0">
        <a href="/posts" class="text-xs font-bold uppercase">Komandna tabla</a>

        <a href="/logout" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
            Izloguj se
        </a>
    </div>
    @endguest
</nav>