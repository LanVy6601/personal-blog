<template>
    <AdminLayout title="Article">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Article detail
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ article.title }}</h2>
                        <div>{{ article.content }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import dayjs from 'dayjs'
export default {
    components: {
        AdminLayout
    },
    props: {
        article: Object
    },
    data() {
        return {

        }
    },
    methods: {
        dayjs
    },
}
</script>

<style>
.article-item {
    padding: 10px;
}

.article-title {
    font-size: 18px;
}

.article-date {
    font-size: 12px;
    color: #444444;
    font-style: italic;
}
</style>