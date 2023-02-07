require('./common');

const inputTitle = document.querySelector('[data-sluger=title]');
const inputSlug = document.querySelector('[data-sluger=slug]');
const btnGetSlug = document.querySelector('[data-sluger=button]');

if (inputTitle && inputSlug && btnGetSlug) {
    inputTitle.addEventListener('focusout', function() {
        if (inputSlug.value === '') {
            getSlug();
        }
    });

    btnGetSlug.addEventListener('click', getSlug);

    function getSlug() {
        let slug;
        // richiesta al server dello slug
        axios.get(btnGetSlug.dataset.sluger_url + '?title=' + inputTitle.value)
            .then(response => inputSlug.value = response.data.slug);
    }
}
