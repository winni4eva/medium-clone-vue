export const ArticleMixin  = {
    data() {
        return {
            articleId: ""
        }
    },
    methods: {
        fetchArticle() {
            axios.get(`api/articles/${this.articleId}`)
                .then(response => this.article = response.data.article)
                .catch(err => {
                    this.error = err.response.data.message;
                    setTimeout(() => {
                        this.error = "";
                    }, 3000);
                });
        },
    }
}