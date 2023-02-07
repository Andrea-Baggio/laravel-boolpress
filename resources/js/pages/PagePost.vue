<template>
    <div>
        <h1>Show del post</h1>
        <p>
        Lo slug del posts è: {{ slug }} <!-- questo slug, avendo settato le sue props in front.js come true, lo troviamo proprio nelle sue props, che andiamo a scrivere in script -->
        </p>
    </div>
</template>

<script>
export default {
    props: [
        'slug',
    ]
}
</script>

<style>

</style>
