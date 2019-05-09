<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>
        <title>Medium Clone</title>
        
        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="container my-4 mx-auto px-4">
            {{-- <div>
                <articles></articles>
            </div> --}}
            <nav class="flex items-center justify-between flex-wrap bg-teal p-6">
                
                <div class="flex items-center flex-no-shrink text-white mr-6">
                    <span class="font-semibold text-xl tracking-tight">Medium</span>
                </div>
                
                <div class="block lg:hidden">
                    <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>

                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div class="text-sm lg:flex-grow">
                    </div>
                    <div>
                        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
                            Signin
                        </a>
                        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
                            Signup
                        </a>
                        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
                            Add Blog
                        </a>
                        {{-- <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal hover:bg-white mt-4 lg:mt-0">Download</a> --}}
                    </div>
                </div>

            </nav>
                  

            <div class="flex mb-4 flex-wrap my-6">
                <div class="w-1/4 bg-grey-light h-full">
                </div>
                <div class="w-2/4 bg-grey h-full">
                    {{-- <h1 class="font-mono text-pink-dark">Headline</h1>
                    <p>
                        Ut enim eu sint tempor nisi quis tempor irure voluptate Lorem dolore quis eu in. Fugiat esse labore duis nostr
                        Officia proident nulla adipisicing voluptate consequat commodo est ad. Officia sit nostrud ea cupidatat culpa nul.
                        Id sunt nulla magna enim enim elit dolore eiusmod. Laboris est voluptate anim excepteur qui ex enim eiusmod volu
                        Duis sunt ea et voluptate velit. Duis excepteur nulla qui excepteur ea. Non eiusmod veniam dolor labo.
                    </p> --}}
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                            <p class="text-grey-darker text-base">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                        </div>
                    </div>
                    
                </div>
                <div class="w-1/4 bg-grey-light h-full">
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
