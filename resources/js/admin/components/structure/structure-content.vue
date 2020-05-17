<template>
    <div class="container">
        <div class="table-container has-padding-15">
            <div class="actions-block">
                <router-link :to="{name: 'add_content', params: {id: $route.params.id}}" class="button is-primary">
                    Add new article
                </router-link>

                <div class="buttons has-addons order-block is-pulled-right">
                    <b class="order-by-text">Order By:</b>
                    <button @click="orderByPosition" :disabled="orderBy.position"
                            :class="['button', {'is-success': orderBy.position}, {'is-selected': orderBy.position}]">
                        Position
                    </button>
                    <button @click="orderByCreated"
                            :class="['button', {'is-success': orderBy.created_at}, {'is-selected': orderBy.created_at}]">
                        Created Date &nbsp;
                        <font-awesome-icon v-if="orderBy.created_at"
                                           :icon="orderBy.created_at === 'asc' ? 'arrow-up' : 'arrow-down'"/>
                    </button>
                    <button @click="orderByUpdated"
                            :class="['button', {'is-success': orderBy.updated_at}, {'is-selected': orderBy.updated_at}]">
                        Updated Date &nbsp;
                        <font-awesome-icon v-if="orderBy.updated_at"
                                           :icon="orderBy.updated_at === 'asc' ? 'arrow-up' : 'arrow-down'"/>
                    </button>
                </div>
            </div>


            <table class="table is-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th v-if="orderBy.position">Change position</th>
                    <th>Updated</th>
                    <th>Created</th>
                    <th>Publish At</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in list">
                    <td>{{item.id}}</td>
                    <td>{{item.name || item.id}}</td>
                    <td>
                        <a-switch @change="setActive($event, item.id)" name="" v-model="item.active"></a-switch>
                    </td>
                    <td v-if="orderBy.position" class="has-text-centered">
                        <button v-if="item.id !== pagination.lastId" @click="downPosition(item.id)"
                                class="button is-small is-primary">
                            <font-awesome-icon icon="angle-down"/>
                        </button>

                        <button v-if="item.id !== pagination.firstId" @click="upPosition(item.id)"
                                class="button is-small is-success">
                            <font-awesome-icon icon="angle-up"/>
                        </button>
                    </td>
                    <td>{{item.updated_at}}</td>
                    <td>{{item.created_at}}</td>
                    <td>{{item.publish_at}}</td>
                </tr>
                </tbody>
            </table>

            <pagination @paginate="paginate" :total="pagination.total"/>

        </div>
    </div>

</template>

<script>
    const PER_PAGE_DEFAULT = 10;

    import ASwitch from '../../components/elements/inputs/a-switch';
    import Pagination from '../../components/elements/pagination/pagination';

    import content from "../../mixins/api/content";

    export default {
        mixins: [content],
        data() {
            return {
                list: [],
                orderBy: {
                    position: true,
                    created_at: null,
                    updated_at: null,
                },
                structure_id: null,
                pagination: {
                    total: 0,
                    current: 1,
                    perPage: PER_PAGE_DEFAULT,
                    firstId: 0,
                    lastId: 0,
                }
            }
        },
        created() {
            this.structure_id = parseInt(this.$route.params.id);
            this.pagination.perPage = parseInt(this.$cookies.get('perPage')) || PER_PAGE_DEFAULT;
            this.loadContent(this.structure_id, this.order, this.way);
        },
        methods: {
            loadContent(structureId, orderBy, way) {
                this.getPaginatedContentList(structureId, orderBy, way, this.pagination.current, this.pagination.perPage)
                    .then(response => {
                        this.pagination.total = response.data.pagination.total;
                        this.pagination.firstId = response.data.pagination.firstItem;
                        this.pagination.lastId = response.data.pagination.lastItem;
                        this.list = response.data.items;
                    })
            },
            setActive(value, id) {
                this.updateActiveStatus(id, value)
            },
            orderByPosition() {
                this.orderBy.position = true;
                this.orderBy.updated_at = null;
                this.orderBy.created_at = null;

                this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                    .then(response => {
                        this.pagination.firstId = response.data.pagination.firstItem;
                        this.pagination.lastId = response.data.pagination.lastItem;
                        this.list = response.data.items;
                    });
            },
            orderByUpdated() {
                this.orderBy.position = false;
                this.orderBy.created_at = null;

                this.orderBy.updated_at = this.orderBy.updated_at === 'desc' ? 'asc' : 'desc';

                this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                    .then(response => {
                        this.pagination.firstId = response.data.pagination.firstItem;
                        this.pagination.lastId = response.data.pagination.lastItem;
                        this.list = response.data.items;
                    })
            },
            orderByCreated() {
                this.orderBy.position = false;
                this.orderBy.updated_at = null;

                this.orderBy.created_at = this.orderBy.created_at === 'desc' ? 'asc' : 'desc';

                this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                    .then(response => {
                        this.pagination.firstId = response.data.pagination.firstItem;
                        this.pagination.lastId = response.data.pagination.lastItem;
                        this.list = response.data.items;
                    })
            },
            upPosition(contentId) {
                this.up(contentId, this.structure_id)
                    .then(response => {
                        if (response.data) {
                            this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                                .then(responseContent => {
                                    this.pagination.firstId = responseContent.data.pagination.firstItem;
                                    this.pagination.lastId = responseContent.data.pagination.lastItem;
                                    this.list = responseContent.data.items;
                                });
                        }
                    })
            },
            downPosition(contentId) {
                this.down(contentId, this.structure_id)
                    .then(response => {
                        if (response.data) {
                            this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                                .then(responseContent => {
                                    this.pagination.firstId = responseContent.data.pagination.firstItem;
                                    this.pagination.lastId = responseContent.data.pagination.lastItem;
                                    this.list = responseContent.data.items;
                                });
                        }
                    })
            },
            paginate(page, perPage) {
                this.pagination.current = page;
                this.pagination.perPage = perPage;

                this.getPaginatedContentList(this.structure_id, this.order, this.way, this.pagination.current, this.pagination.perPage)
                    .then(responseContent => {
                        this.pagination.firstId = responseContent.data.pagination.firstItem;
                        this.pagination.lastId = responseContent.data.pagination.lastItem;
                        this.list = responseContent.data.items;
                    });
            }
        },
        computed: {
            order() {
                if (this.orderBy.position) {
                    return 'position';
                }

                if (this.orderBy.updated_at) {
                    return 'updated_at';
                }

                if (this.orderBy.created_at) {
                    return 'created_at';
                }

                return 'position';
            },
            way() {
                if (this.orderBy.position) {
                    return 'desc';
                }

                if (this.orderBy.updated_at) {
                    return this.orderBy.updated_at;
                }

                if (this.orderBy.created_at) {
                    return this.orderBy.created_at;
                }

                return 'desc';
            }
        },
        components: {
            ASwitch,
            Pagination
        }
    }
</script>

<style scoped>
    .order-block {
        display: inline-block;
    }

    .actions-block {
        margin-bottom: 5px;
    }

    .order-by-text {
        padding: 8px;
        display: inline-block;
    }
</style>
