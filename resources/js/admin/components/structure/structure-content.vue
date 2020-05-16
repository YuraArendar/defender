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
                        <button v-if="index < list.length - 1" @click="downPosition(item.id)" class="button is-small is-primary">
                            <font-awesome-icon icon="angle-down"/>
                        </button>

                        <button v-if="index > 0" @click="upPosition(item.id)" class="button is-small is-success">
                            <font-awesome-icon icon="angle-up"/>
                        </button>
                    </td>
                    <td>{{item.updated_at}}</td>
                    <td>{{item.created_at}}</td>
                    <td>{{item.publish_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    import ASwitch from '../../components/elements/inputs/a-switch';

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
            }
        },
        created() {
            this.structure_id = parseInt(this.$route.params.id);
            this.loadContent(this.structure_id, 'position', 'desc');
        },
        methods: {
            loadContent(structureId, orderBy, way) {
                this.getContentList(structureId, orderBy, way)
                    .then(response => {
                        this.list = response.data;
                    })
            },
            setActive(value, id) {
                this.updateActiveStatus(id, value)
            },
            orderByPosition() {
                this.orderBy.position = true;
                this.orderBy.updated_at = null;
                this.orderBy.created_at = null;

                this.getContentList(this.structure_id, 'position', 'desc')
                    .then(response => {
                        this.list = response.data;
                    });
            },
            orderByUpdated() {
                this.orderBy.position = false;
                this.orderBy.created_at = null;

                this.orderBy.updated_at = this.orderBy.updated_at === 'desc' ? 'asc' : 'desc';

                this.getContentList(this.structure_id, 'updated_at', this.orderBy.updated_at)
                    .then(response => {
                        this.list = response.data;
                    })
            },
            orderByCreated() {
                this.orderBy.position = false;
                this.orderBy.updated_at = null;

                this.orderBy.created_at = this.orderBy.created_at === 'desc' ? 'asc' : 'desc';

                this.getContentList(this.structure_id, 'created_at', this.orderBy.created_at)
                    .then(response => {
                        this.list = response.data;
                    })
            },
            upPosition(contentId) {
                this.up(contentId, this.structure_id)
                    .then(response => {
                        this.list = response.data;
                    })
            },
            downPosition(contentId) {
                this.down(contentId, this.structure_id)
                    .then(response => {
                        this.list = response.data;
                    })
            }
        },
        components: {
            ASwitch
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
