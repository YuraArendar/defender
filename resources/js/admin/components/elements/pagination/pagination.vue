<template>
    <nav v-if="show" class="pagination" role="navigation" aria-label="pagination">
        <a v-if="showPrevious" class="pagination-previous" @click="previous">Previous</a>
        <a v-if="showNext" class="pagination-next" @click="next">Next page</a>
        <ul class="pagination-list">
            <li v-if="showFirstPage">
                <a class="pagination-link" :aria-label="`Goto first page`" @click="first">{{firstPage}}</a>
            </li>
            <li v-if="showDotsBefore">
                <span class="pagination-ellipsis">&hellip;</span>
            </li>
            <li v-if="showPrevious">
                <a class="pagination-link" :aria-label="`Goto page ${previousPage}`"
                   @click="previous">{{previousPage}}</a>
            </li>
            <li>
                <a class="pagination-link is-current" :aria-label="`Page ${currentPage}`" aria-current="page">{{currentPage}}</a>
            </li>
            <li v-if="showNext">
                <a class="pagination-link" :aria-label="`Goto page ${nextPage}`" @click="next">{{nextPage}}</a>
            </li>
            <li v-if="showDotsAfter">
                <span class="pagination-ellipsis">&hellip;</span>
            </li>
            <li v-if="showLastPage">
                <a class="pagination-link" :aria-label="`Goto page ${lastPage}`" @click="last">{{lastPage}}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    const PER_PAGE_DEFAULT = 10;

    export default {
        name: "pagination",
        data() {
            return {
                currentPage: 1,
                perPage: PER_PAGE_DEFAULT,
                firstPage: 1,
                totalItems: 0
            }
        },
        created() {
            this.setPerPage();
        },
        props: {
            total: {
                required: true,
                type: Number
            },
        },
        methods: {
            paginate(page) {
                this.currentPage = page;
                this.$emit('paginate', page, this.perPage)
            },
            next() {
                this.currentPage = this.nextPage;
                this.$emit('paginate', this.currentPage, this.perPage)
            },
            previous() {
                this.currentPage = this.previousPage;
                this.$emit('paginate', this.currentPage, this.perPage)
            },
            first() {
                this.currentPage = this.firstPage;
                this.$emit('paginate', this.currentPage, this.perPage)
            },
            last() {
                this.currentPage = this.lastPage;
                this.$emit('paginate', this.currentPage, this.perPage)
            },
            setPerPage() {
                if (this.$cookies.get('perPage')) {
                    this.perPage = parseInt(this.$cookies.get('perPage'));
                } else {
                    this.perPage = PER_PAGE_DEFAULT;
                    this.$cookies.set('perPage', this.perPage);
                }
            }
        },
        watch: {
            total(total) {
                this.totalItems = total;
            }
        },
        computed: {
            show() {
                return this.totalItems > this.perPage;
            },
            showPrevious() {
                return this.currentPage > this.firstPage;
            },
            showNext() {
                return this.currentPage < this.lastPage;
            },
            showFirstPage() {
                return this.currentPage > this.firstPage + 1;
            },
            showLastPage() {
                return this.lastPage > this.currentPage + 1;
            },
            showDotsBefore() {
                return this.currentPage - this.firstPage > 2;
            },
            showDotsAfter() {
                return this.lastPage - this.currentPage > 2;
            },
            lastPage() {
                return Math.ceil(this.total / this.perPage);
            },
            previousPage() {
                return this.currentPage - 1;
            },
            nextPage() {
                return this.currentPage + 1;
            }
        }
    }
</script>

<style scoped>

</style>
