<template>
    <div class="container-inside-header">
        <NewsTableComponent></NewsTableComponent>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import NewsTableComponent from "../Tables/NewsTableComponent.vue";

export default defineComponent({
    name: 'Main',
    components: {NewsTableComponent},

});
</script>


<style>
header {
    width: 100%;
    background-color: #f4f4f4;
}

.container-inside-header {
    width: 100%;
}

</style>
