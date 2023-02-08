<template>
    <div class="grid">
        <div v-for="post in arrRandom" :key="post.id" class="tile">
            <router-link :to="{name: 'postsShow', params: {slug: post.slug}}">
                <img :src="post.image" alt="">
            </router-link>
        </div>
    </div>
  </template>

  <script>

  export default {
    data() {
        return {
            arrRandom: null,
        }
    },
    created() {
        axios.get('/api/posts/random')
            .then(axiosResponse => this.arrRandom = axiosResponse.data.results);
    }
  }
  </script>

  <style lang="scss" scoped>

    .grid {
        display: flex;
        flex-wrap: wrap;
        height: 70vh;
    }

    .tile {
        flex: 0 0 calc(100% / 3);
        height: calc(100% / 3);
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

  </style>
