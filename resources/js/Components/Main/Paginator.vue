<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: pageIndex <= 1 }">
                <a class="page-link" href="#" @click.prevent="setPage(1)">First</a>
            </li>
            <li class="page-item" :class="{ disabled: pageIndex <= 1 }">
                <a class="page-link" href="#" @click.prevent="setPage(pageIndex - 1)">&laquo;</a>
            </li>
            <li
                class="page-item"
                v-for="page in pagesArray"
                :key="page"
                :class="{ active: page === pageIndex }"
            >
                <a class="page-link" href="#" @click.prevent="setPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: pageIndex >= totalPages }">
                <a class="page-link" href="#" @click.prevent="setPage(pageIndex + 1)">&raquo;</a>
            </li>
            <li class="page-item" :class="{ disabled: pageIndex >= totalPages }">
                <a class="page-link" href="#" @click.prevent="setPage(totalPages)">Last</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        pageIndex: {
            type: Number,
            required: true
        },
        totalPages: {
            type: Number,
            required: true
        }
    },
    computed: {
        pagesArray() {
            return Array.from({ length: this.totalPages }, (_, i) => i + 1);
        }
    },
    methods: {
        setPage(page) {
            if (page !== this.pageIndex && page > 0 && page <= this.totalPages) {
                this.$emit("page-changed", page);
            }
        }
    }
};
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.page-item a {
    transition: background-color 0.3s ease;
}

.page-item:not(.disabled) a:hover {
    background-color: #f5f5f5;
}
</style>
