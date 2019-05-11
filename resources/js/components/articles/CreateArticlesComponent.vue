<template>
    <div class="flex mb-4 flex-wrap my-6">
        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 h-full">
            <form class="w-full max-w-md mt-6">

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="images">
                            Images
                        </label>
                        <input 
                            @change="imageSelected"
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                            id="images" 
                            type="file"
                            multiple>
                        
                        <div class="flex flex-wrap bg-white">
                            <div
                                v-for="(src, index) in srcUrls" v-bind:key="index" 
                                class="h-48 w-48 w-2/5 p-2" 
                                v-bind:style="{'background-image': 'url('+src+')'}"
                                title="uploaded image">
                            </div>
                        </div>

                    </div>

                    <div class="w-full px-3 my-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                            Title
                        </label>
                        <input 
                            v-model="article.title" 
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                            id="title" 
                            type="text">

                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                            Article
                        </label>
                        <textarea v-model="article.description" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey h-64" id="description"/>

                    </div>
                    <div class="flex items-center border-b border-b-2 border-teal py-2 w-full px-3">
                        <input v-model="tag" v-on:keyup.space="addTag($event)" class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="fashion" aria-label="tag">

                        <p class="text-grey-dark text-xs italic">Enter tag and hit space button to save</p>
                    </div>
                    <div v-for="(tag, index) in article['tags']" v-bind:key="index" class="my-6">
                        <a class="float-right hover:bg-blue-light" @click="removeTag(index)">x</a>
                        <button  
                            class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white mr-2 ml-2 py-2 px-4 border border-blue hover:border-transparent rounded">
                            {{tag}}
                        </button>
                    </div>
                </div>
   
                <button class="bg-blue hover:bg-blue-light text-white my-6 font-bold py-2 px-4 border-b-4 border-blue-dark hover:border-blue float-right rounded">
                    Save
                </button>
            </form>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
    </div>
</template>

<script>
import _ from 'lodash'

export default {
    data() {
        return {
            article: {
                title: "",
                description: "",
                tags: [],
                images: {}
            },
            srcUrls: [],
            tag: "",
            error: ""
        }
    },

    mounted() {
        //this.fetchArticles();
    },

    methods: {
        fetchArticles() {
            // axios.get('api/articles')
            //     .then(response => this.articles = response.data.articles.data)
            //     .catch(err => {
            //         this.error = err.response.data.message;
            //         setTimeout(() => {
            //             this.error = "";
            //         }, 3000);
            //     })
        },
        addTag(event) {
            this.article['tags'].push(event.srcElement.value);
            this.tag = "";
        },
        removeTag(index) {
            this.article.tags.splice(index, 1);
        },
        imageSelected(event) {
            //const selectedImages = event['target']['files'];
            // this.article.images = {...selectedImages, ...this.article.images}
            //console.log(selectedImages)
            const fileLength = event['target']['files'].length;

            for (let index = 0; index < fileLength; index++) {
                this.srcUrls.push(
                    URL.createObjectURL(event.target.files[index])
                );
            }
        }
    }
}
//
</script>
