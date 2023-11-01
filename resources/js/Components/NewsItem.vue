<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="max-width: 90%; overflow: hidden;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">{{ newsItem.title }}</h3>
                <h5 class="card-subtitle mb-3 text-muted text-center">{{ newsItem.id }}</h5>
                <p class="card-text text-justify">{{ newsItem.description ? newsItem.description : 'No description' }}</p>
                <p class="card-text mt-3"><small class="text-muted">URL: {{ newsItem.url }}</small></p>
                <p class="card-text"><small class="text-muted">Short Description: {{ newsItem.shortDescription }}</small></p>
                <p class="card-text"><small class="text-muted">Created At: {{ newsItem.createdAt }}</small></p>
                <p class="card-text"><small class="text-muted">Status: {{ newsItem.status }}</small></p>
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" @click="changesNewsStatus" class="btn btn-danger btn-lg mr-3">Change Status</button>
                    &nbsp;
                    <button type="button" @click="goBack" class="btn btn-secondary btn-lg">Back</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import {newsItemModel} from "./Model/NewsItemModel"
import apiMethods from "../Core/apiMethods";
import {useToast} from "vue-toastification";

export default {
    props: ['id'],
    data() {
        return {
            newsItem: newsItemModel
        };
    },
    mounted() {
       this.getSingleNews();
    },
    methods: {
        async getSingleNews() {
            try {
                const response = await apiMethods.getSingleNews(this.id);
                this.newsItem = response.data.news;
            } catch (error) {
                useToast().error(`Something went wrong: ${error.message}`);
            }
        },
        async changesNewsStatus() {
            try {
                await apiMethods.changesNewsStatus({id: this.id, status: 'hidden'});
            } catch (error) {
                useToast().error(`Something went wrong: ${error.message}`);
            } finally {
                useToast().success('Status successfully changed');

                await this.$router.push('/');
            }
        },
        goBack() {
            this.$router.go(-1);
        }
    },
}
</script>
