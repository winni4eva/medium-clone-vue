export const ArticleMixin  = {
    data() {
        return {
            articleId: "",
            unsetImages: false,
        }
    },
    methods: {
        fetchArticle() {
            axios.get(`api/articles/${this.articleId}`)
                .then(response => {
                    this.article = response.data.article;
                    if(this.unsetImages) {
                        this.article.images = [];
                    }
                })
                .catch(err => {
                    this.error = err.response.data.message;
                    setTimeout(() => {
                        this.error = "";
                    }, 3000);
                });
        },
    }
}