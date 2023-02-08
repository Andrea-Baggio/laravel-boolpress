<template>
        <div class="container">
            <h1>Index dei post</h1>
            <div class="row g-3">
                <div v-for="post in arrPosts" :key="post.id" class="col-sm-6 col-md-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text flex-grow-1">{{ post.excerpt }}</p>
                            <router-link class="btn btn-primary" :to="{name: 'postsShow', params: {slug: post.slug}}">Leggi</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" >1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" >3</a></li>
                    <li class="page-item">
                        <a class="page-link" >Next</a>
                    </li>
                </ul>
            </nav>
        </div>
  </template>

  <script>
  export default {
    data() {
        return {
            arrPosts: [],
        }
    },
    created() {
        axios.get('/api/posts')
        .then(axiosResponse => this.arrPosts = axiosResponse.data.results.data);
    }
  }
  </script>

  <style>

  </style>
