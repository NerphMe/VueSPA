<template>
    <div class="loader-overlay" v-show="isLoading">
        <div class="loader"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h3 class="header-title">News Table</h3>
            </div>

            <div class="col-md-12 mb-4">
                <button class="btn btn-success" @click="generateNews()">Generate News</button>
            </div>

            <div class="col-md-12">
                <table class="table table-striped table-hover modern-table rounded-table">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Url</th>
                        <th>Short Description</th>
                        <th>Created At</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="newsItem in news" :key="newsItem.id">
                        <td>{{ newsItem.id }}</td>
                        <td><router-link :to="`/news/${newsItem.id}`">{{ newsItem.title }}</router-link></td>
                        <td>{{ newsItem.url }}</td>
                        <td>{{ newsItem.shortDescription }}</td>
                        <td>{{ newsItem.createdAt }}</td>
                        <td>{{ newsItem.status }}</td>
                    </tr>
                    </tbody>
                </table>
                <paginator
                    :page-index="pageIndex"
                    :total-pages="Math.ceil(newsCount / 10)"
                    @page-changed="updatePage"
                ></paginator>
            </div>
        </div>
    </div>
</template>

<script>
import apiMethods from "../../Core/apiMethods";
import Paginator from "../Main/Paginator.vue";
import {defineComponent} from 'vue';
import {useToast} from "vue-toastification";
import {newsItemModel} from "../Model/NewsItemModel"

export default defineComponent({
    name: 'NewsTable',
    components: {Paginator},
    data() {
        return {
            news: [],
            isLoading: true,
            pageIndex: 1,
            newsCount: 0,
            newsItem: newsItemModel
        }
    },
    mounted() {
        this.getNews()
    },
    methods: {
        async getNews() {
            try {
                const response = await apiMethods.getNews({page: this.pageIndex});
                this.news = response.data.news;
                this.newsCount = response.data.newsCount;
            } catch (error) {
                useToast().error(`Something went wrong: ${error.message}`);
            } finally {
                this.isLoading = false;
            }
        },
        async generateNews() {
            try {
                this.isLoading = true;
                await apiMethods.generateNews();
            } catch (error) {
                useToast().error(`Something went wrong: ${error.message}`);
            } finally {
                this.isLoading = false;
                await this.getNews();
                useToast().success('Successfully added 20 records.');
            }
        },
        async updatePage(page) {
            this.isLoading = true;
            this.pageIndex = page;
            await this.getNews();
        },
        async newsStatusChanged() {
            useToast().success('Successfully added 20 records.');
        }

    }
});
</script>

<style scoped>
.loader-overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader {
    border: 12px solid #f3f3f3;
    border-top: 12px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.modern-table {
    width: 80%;
    border-collapse: collapse;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);
}

.modern-table th,
.modern-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

.modern-table thead th {
    background-color: #0b5ed7;
    color: white;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.modern-table tbody tr {
    transition: background-color 0.3s ease;
}

.modern-table tbody tr:hover {
    background-color: rgba(85, 85, 85, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    border: 1px solid #e1e1e1;
}

table th, table td {
    padding: 15px;
    border-bottom: 1px solid #e1e1e1;
}

table th {
    background-color: #f4f4f4;
    color: #333;
    font-weight: 600;
}

table tbody tr:hover {
    background-color: #f9f9f9;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);
    border-radius: 15px;
}

.rounded-table {
    border-radius: 15px;
}

.header-title {
    font-size: 2em;
    color: black;
    padding: 10px;
    border-radius: 10px;
    margin-top: 20px;
}
</style>
