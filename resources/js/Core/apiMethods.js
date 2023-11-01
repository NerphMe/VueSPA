import apiClient from './apiClient';

export default {
    getNews(pageIndex) {
        return apiClient.get(
            `/news?pageIndex=${pageIndex.page}`
        );
    },
    getSingleNews(id) {
        return apiClient.get(
            `/news/${id}`
        );
    },
    changesNewsStatus(data) {
        return apiClient.patch(`/news`, {
                id: data.id,
                status: data.status
            }
        );
    },
    generateNews() {
        return apiClient.post(
            '/news/generate'
        )
    }
}
