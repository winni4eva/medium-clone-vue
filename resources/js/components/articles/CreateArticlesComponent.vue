<template>
    <div class="flex mb-4 flex-wrap my-6">
        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 h-full">
            <form class="w-full max-w-md mt-6">

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                            Images
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="title" type="file">

                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                            Title
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="title" type="text">

                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                            Article
                        </label>
                        <textarea class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey h-64" id="description"/>

                    </div>
                    <div class="flex items-center border-b border-b-2 border-teal py-2 w-full px-3">
                        <input class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="sports" aria-label="tag">

                        <button class="flex-no-shrink border-transparent border-4 text-teal hover:text-teal-darker text-sm py-1 px-2 rounded" type="button">
                        Add Tag
                        </button>
                    </div>
                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                        Button
                    </button>
                </div>
   
                <button class="bg-blue hover:bg-blue-light text-white font-bold py-2 px-4 border-b-4 border-blue-dark hover:border-blue float-right rounded">
                    Save
                </button>
            </form>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
    </div>
</template>
