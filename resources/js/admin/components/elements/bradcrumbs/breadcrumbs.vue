<template>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <a href="#">
        <span class="icon is-small">
            <font-awesome-icon icon="home"/>
        </span>
                    <span>Bulma</span>
                </a>
            </li>
            <li>
                <a href="#">
        <span class="icon is-small">
            <font-awesome-icon icon="book"/>
        </span>
                    <span>Documentation</span>
                </a>
            </li>
            <li>
                <a href="#">
        <span class="icon is-small">
            <font-awesome-icon icon="puzzle-piece"/>
        </span>
                    <span>Components</span>
                </a>
            </li>
            <li class="is-active">
                <a href="#">
        <span class="icon is-small">
            <font-awesome-icon icon="thumbs-up"/>
        </span>
                    <span>Breadcrumb</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "breadcrumbs"
    }
</script>

<style scoped>

</style>
