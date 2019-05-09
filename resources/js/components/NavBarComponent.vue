<template>
    <nav class="flex items-center justify-between flex-wrap bg-grey-lighter p-6 shadow-lg">
                
        <div class="flex items-center flex-no-shrink text-grey-darkest mr-6">
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
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-grey-darkest hover:text-white mr-4">
                    Signin
                </a>
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-grey-darkest hover:text-white mr-4">
                    Signup
                </a>
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-grey-darkest hover:text-white">
                    Add Blog
                </a>
            </div>
        </div>
    </nav>
</template>
