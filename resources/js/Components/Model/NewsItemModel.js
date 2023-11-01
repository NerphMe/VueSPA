export const newsItemModel = () => {
    return {
        id: Number,
        title: String,
        url: String,
        description: null|String,
        shortDescription: String,
        createdAt: String,
        status: String,
    };
};
