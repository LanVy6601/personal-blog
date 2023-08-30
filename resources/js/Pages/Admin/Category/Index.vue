<template>
    <AdminLayout title="Category">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Category list
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <button @click="showCreateForm = true"
                        class="rounded-full bg-indigo-500 hover:bg-indigo-400 px-3 py-1 mb-4 text-white">
                        + Create new category</button>
                </div>
                <div v-if="showCreateForm" class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <form @submit.prevent="createCategory">
                            <InputLabel for="name" value="Category name" class="mt-5 mb-1" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="rounded-lg bg-indigo-500 hover:bg-indigo-400 px-8 py-2 mt-4 mr-4 text-white">Create</button>
                                <button @click="showCreateForm = false"
                                    class="rounded-lg bg-white hover:bg-indigo-300 border border-indigo-500 hover:border-indigo-300 px-8 py-2 mt-4 text-indigo-600 hover:text-white">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <div v-for="category in categories" class="category-item">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="category-name">
                                        {{ category.name }}
                                    </div>
                                </div>
                                <div>
                                    <button @click="destroyCategory(category.id)"
                                        class="px-2 bg-red-500 text-white rounded-lg mr-2">Delete</button>
                                    <button class="px-2 bg-orange-300 rounded-lg">
                                        <a :href="route('admin.category.edit', category.id)">Edit</a>
                                    </button>
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
import { router, useForm } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'

export default {
    components: {
        AdminLayout, InputLabel, TextInput
    },
    props: {
        categories: Array
    },
    data() {
        return {
            showCreateForm: false,
            form: useForm({
                name: ''
            })
        }
    },
    methods: {
        dayjs,
        createCategory() {
            this.form.post(route('admin.category.store'), {
                onSuccess: () => {
                    this.showCreateForm = false
                }
            })
        },
        destroyCategory(id) {
            router.delete(route('admin.category.destroy', id), {
                onSuccess: () => {
                    window.location = router('category.index')
                }
            })
        }
    },
}
</script>

<style>
.category-item {
    padding: 10px;
}

.category-name {
    font-size: 18px;
}

.category-name:hover {
    color: blueviolet;
}
</style>