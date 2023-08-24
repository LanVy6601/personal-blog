<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit new article
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <form @submit.prevent="updateArticle(article.id)">
                            <InputLabel for="category" value="Category" class="mb-1"/>
                            <select name="category" id="category" v-model="form.category_id"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option v-for="category in categories" :value="category.id" :key="category.id">
                                    {{ category.name }}
                                </option>
                            </select>

                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" />
                            <InputError class="mt-2" :message="form.errors.title" />

                            <InputLabel value="Content" class="mt-5 mb-1" />
                            <TinyMceEditor v-model="form.content" />
                            <InputError class="mt-2" :message="form.errors.content" />

                            <InputLabel value="Tags" class="mt-5 mb-1"/>
                            <template v-for="tag in tags">
                                <div class="inline-flex items-center mr-10 bg-indigo-100 p-1 rounded-md">
                                    <input :id="'tag-' + tag.id" type="checkbox" :value="tag.id" v-model="form.tags" class="rounded-md">
                                    <label :for="'tag-' + tag.id" class="ml-2">{{ tag.name }}</label>
                                </div>
                            </template>

                            <div class="flex justify-center">
                                <button type="submit"
                                    class="rounded-lg bg-indigo-500 hover:bg-indigo-400 px-8 py-2 mt-4 text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import TinyMceEditor from '@/Components/Admin/TinyMceEditor.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        TinyMceEditor, AppLayout, TextInput, InputLabel, InputError
    },
    props: {
        article: Object
    },
    data() {
        return {
            form: useForm({
                title: this.article.title,
                content: this.article.content,
                category_id: this.article.category_id,
                tags: this.article.tags
            })
        }
    },
    methods: {
        updateArticle(id) {
            this.form.put(route('article.update', id), {
                onSuccess: () => {
                    window.location = route('article.show', id)
                },
            })
        }
    }
}
</script>