<template>
    <AdminLayout title="Article">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My articles
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <button class="rounded-full bg-indigo-500 hover:bg-indigo-400 px-3 py-1 mb-4 text-white"><a
                            :href="route('admin.article.create')">+ Create new article</a></button>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <div v-for="article in articles" class="article-item">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="article-title">
                                        <a :href="route('admin.article.show', article.id)">{{ article.title }}</a>
                                    </div>
                                    <span class="article-date">{{ dayjs(article.updated_at).format('YYYY-MM-DD HH:mm')
                                    }}</span>
                                </div>
                                <div>
                                    <button @click="destroyArticle(article.id)"
                                        class="px-2 bg-red-500 text-white rounded-lg mr-2">Delete</button>
                                    <button class="px-2 bg-orange-300 rounded-lg"><a
                                            :href="route('admin.article.edit', article.id)">Edit</a></button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { router } from '@inertiajs/vue3'
import dayjs from 'dayjs'

export default {
    components: {
        AdminLayout
    },
    props: {
        articles: Array
    },
    data() {
        return {

        }
    },
    methods: {
        dayjs,
        destroyArticle(id) {
            router.delete(route('admin.article.destroy', id), {
                onSuccess: () => {
                    window.location = router('article.index')
                }
            })
        }
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

.article-title:hover {
    color: blueviolet;
}

.article-date {
    font-size: 12px;
    color: #444444;
    font-style: italic;
}</style>