<template>
    <div>
        <div class="columns">
            <div class="column is-one-quarter">
                <tree  :tree="tree"></tree>
            </div>

            <div class="column">
                <edit-form></edit-form>
            </div>
        </div>

    </div>
</template>

<script>
    import tree from '../elements/tree/tree';
    import EditForm from './edit-form';

    export default {
        data() {
            return {
                tree: {
                    name: 'Site menu',
                    meta: {

                    },
                    id: 1,
                    children: [
                        {
                            name: 'Main',
                            meta: {

                            },
                            id: 2,
                        },
                        {
                            name: 'Blog',
                            meta: {

                            },
                            id: 3,
                            children: [
                                {
                                    name: 'Velo',
                                    meta: {

                                    },
                                    id: 4
                                },
                                {
                                    name: 'Moto',
                                    meta: {

                                    },
                                    id: 5
                                },
                                {
                                    name: 'Other',
                                    meta: {

                                    },
                                    id: 6,
                                    children: [
                                        {
                                            name: 'Test1',
                                            meta: {

                                            },
                                            id: 7
                                        },
                                        {
                                            name: 'Test 2',
                                            meta: {

                                            },
                                            id: 8
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'About us',
                            meta: {

                            }
                        }
                    ]
                }
            }
        },
        components: {
            tree,
            EditForm
        }
    }
</script>

<style scoped>

</style>
