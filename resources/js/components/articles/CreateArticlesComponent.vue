<template>
    <div class="flex mb-4 flex-wrap my-6">
        <div v-if="this.successMessage" class="bg-green-lightest border border-green-dark text-blue-dark px-4 py-3 w-full rounded relative" role="alert">
            <span class="block sm:inline">{{this.successMessage}}</span>
        </div>
        <div v-if="this.error && this.error.message" class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 w-full rounded relative" role="alert">
            <span class="block sm:inline">{{this.error.message}}</span>
        </div>

        <div class="w-1/4 bg-grey-light h-full">
        </div>
        <div class="w-2/4 h-full">
            <form class="w-full max-w-md mt-6">

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 my-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                            Title
                        </label>
                        <input 
                            v-model="article.title" 
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                            id="title" 
                            type="text"
                            placeholder="My Best Programming Book Of All Time">
                        <p 
                            class="text-red-dark text-xs italic" 
                            v-if="this.error && this.error.errors && this.error.errors.title && Array.isArray(this.error.errors.title)">
                            {{this.error.errors.title[0]}}
                        </p>
                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                            Article
                        </label>
                        <textarea v-model="article.description" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey h-64" id="description"/>
                        <p 
                            class="text-red-dark text-xs italic" 
                            v-if="this.error && this.error.errors && this.error.errors.description && Array.isArray(this.error.errors.description)">
                            {{this.error.errors.description[0]}}
                        </p>
                    </div>
                    <div class="flex items-center border-b border-b-2 border-teal py-2 w-full px-3">
                        <input 
                            v-model="tag" 
                            v-on:keyup.space="addTag($event)" 
                            class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none" 
                            type="text" 
                            placeholder="Enter a tag and hit the space button to save" 
                            aria-label="tag">

                        <p 
                            class="text-red-dark text-xs italic"
                            v-if="this.error && this.error.errors && this.error.errors.tags && Array.isArray(this.error.errors.tags)">
                            {{this.error.errors.tags[0]}}
                        </p>
                    </div>
                    <div v-for="(tag, index) in article['tags']" v-bind:key="index" class="my-6">
                        <a class="float-right hover:bg-blue-light" @click="removeTag(index)">x</a>
                        <button  
                            class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white mr-2 ml-2 py-2 px-4 border border-blue hover:border-transparent rounded">
                            {{tag}}
                        </button>
                    </div>

                    <div class="w-full px-3 my-6">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="images">
                            Images
                        </label>
                        <input 
                            @change="imageSelected"
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                            id="images" 
                            type="file"
                            multiple>
                        <p 
                            class="text-red-dark text-xs italic" 
                            v-if="this.error && this.error.errors && this.error.errors.images && Array.isArray(this.error.errors.images)">
                            {{this.error.errors.images[0]}}
                        </p>
                        
                        <div class="flex flex-wrap bg-white">
                            <div
                                v-for="(src, index) in article.images" v-bind:key="index" 
                                class="h-48 w-48 w-2/5 p-2 mr-2" 
                                v-bind:style="{'background-image': 'url('+src['img_path']+')'}"
                                title="uploaded image">
                                <a class="float-right text-red-dark hover:bg-white pin-r" @click="removeImage(index)">delete</a>
                            </div>
                        </div>

                    </div>
                </div>
   
                <button
                    @click="createArticle()" 
                    class="bg-blue hover:bg-blue-light text-white my-6 font-bold py-2 px-4 border-b-4 border-blue-dark hover:border-blue float-right rounded"
                    type="button">
                    Save
                </button>
            </form>
        </div>
        <div class="w-1/4 bg-grey-light h-full">
        </div>
    </div>
</template>

<script>
import { serverBus } from '../../app';
import { ArticleMixin } from '../mixins/ArticleMixin';

export default {
    name: "CreateArticle",
    mixins: [ArticleMixin],
    data() {
        return {
            article: {
                title: "",
                description: "",
                tags: [],
                images: []
            },
            successMessage: "",
            tag: "",
            error: "",
            erroMessage: "",
            update: false,
        }
    },
    mounted() {
        if (this.$route.params.articleId > 0) {
            this.update = true;
            this.articleId = this.$route.params.articleId;
            this.fetchArticle();
        }
    },
    methods: {
        createArticle() {
            let formData = new FormData()

            formData.append('title', this.article.title);
            formData.append('description', this.article.description);
            formData.append('tags', JSON.stringify(this.article.tags));

            const imagesLength = this.article.images.length;
        
            for (let index = 0; index < imagesLength; index++) {
                formData.append("images[]", this.article.images[index], this.article.images[index]['name'])
            }

            const headers = { 
                headers: {
                    "Accept": "application/json",
                    "Authorization": `Bearer ${localStorage.getItem('mvToken')}`
                } 
            };

            axios.post('api/articles', formData, headers)
                .then(response => {
                    this.error = "";
                    this.successMessage = response.data.success;
                    setTimeout(() => {
                        this.successMessage = "";
                        this.$router.push('/articles');
                    }, 3000);
                })
                .catch(err => {
                    this.error = err.response.data;

                    if(err.response.status === 401) {
                        this.$router.push('/login');
                        localStorage.removeItem('mvToken');
                        serverBus.$emit('tokenChanged', "");
                    }
                    setTimeout(() => {
                        this.error = "";
                    }, 3000);
                });
        },
        addTag(event) {
            this.article['tags'].push(event.srcElement.value);
            this.tag = "";
        },
        removeTag(index) {
            this.article.tags.splice(index, 1);
        },
        removeImage(index) {
            this.article.images.splice(index, 1);
        },
        imageSelected(event) {
            const filesLength = event['srcElement']['files'].length;
            for (let index = 0; index < filesLength; index++) {
                event['srcElement']['files'][index]['img_path'] = URL.createObjectURL(event.target.files[index]);
                this.article.images.push(event['srcElement']['files'][index]);
            }
        }
    }
}

</script>
