<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create new article
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <form @submit.prevent="createArticle">
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"/>
                            <InputError class="mt-2" :message="form.errors.title" />
                            <InputLabel value="Content" class="mt-5 mb-1"/>
                            <TinyMceEditor v-model="form.content"/>
                            <InputError class="mt-2" :message="form.errors.content" />
                            <div class="flex justify-center">
                                <button type="submit" class="rounded-lg bg-indigo-500 hover:bg-indigo-400 px-8 py-2 mt-4 text-white">Create</button>
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
    data() {
        return {
            form: useForm({
                title: '',
                content: ''
            })
        }
    },
    methods: {
        createArticle() {
            this.form.post(route('article.store'), {
                onSuccess: () => {
                    window.location = route('article.index')
                },
            }
            )
        }
    }
}
</script>