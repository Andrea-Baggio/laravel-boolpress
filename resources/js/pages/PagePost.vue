<template>
    <div class="container">
        <h1>{{objPost.title}}</h1>
        <p>
            {{objPost.content}} <!-- questo slug, dato che abbiamo settato le sue props in front.js come true, lo ritroviamo nelle props di PagePost.vue, che andiamo a scrivere nello script -->
        </p>
    </div>
</template>

<script>
export default {
    props: [
        'slug',
    ],
    data() {
        return {
            objPost: [],
        }
    },
    created() {
        axios.get('/api/posts/' + this.slug) //qua metto un + perché la show vuole anche l'argomento (api/posts/{post}), che in questo caso è lo slug (devo scrivere this.NomeDellaProps, che in questo caso è slug)
            .then(axiosResponse => this.objPost = axiosResponse.data.results);
    }
  }
</script>

<style>

</style>
