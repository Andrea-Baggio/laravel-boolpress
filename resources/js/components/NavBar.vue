<template>
    <nav class="navbar navbar-expand-md bg-light">
        <div class="container-fluid">
            <router-link :to="{name: 'home'}" class="navbar-brand">Boolpress</router-link><!-- per evitare che il browser metta nel link un # bisogna usare router-link -->
            <!-- per usare il :to in maniera dinamica dobbiamo impostare un name nell'array delle routes, questo ci permette di modificare la path a nostro piacimento senza doverci curare di modificare questo link -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link :to="{name: 'postsIndex'}" class="nav-link">Posts</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'about'}" class="nav-link">About</router-link>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {

}
</script>

<style>

</style>
