                                    
<template>
    <AdminLayout title="Tag">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tag list
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <button @click="showCreateForm = true"
                        class="rounded-full bg-indigo-500 hover:bg-indigo-400 px-3 py-1 mb-4 text-white">
                        + Create new tag</button>
                </div>
                <div v-if="showCreateForm" class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4">
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <form @submit.prevent="createTag">
                            <InputLabel for="name" value="Tag name" class="mt-5 mb-1" />
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
                        <div v-for="tag in tags" class="tag-item">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="tag-name">
                                        {{ tag.name }}
                                    </div>
                                </div>
                                <div>
                                    <button @click="destroyTag(tag.id)"
                                        class="px-2 bg-red-500 text-white rounded-lg mr-2">Delete</button>
                                    <button class="px-2 bg-orange-300 rounded-lg">
                                        <a :href="route('admin.tag.edit', tag.id)">Edit</a>
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
        tags: Array
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
        createTag() {
            this.form.post(route('admin.tag.store'), {
                onSuccess: () => {
                    this.showCreateForm = false
                }
            })
        },
        destroyTag(id) {
            router.delete(route('admin.tag.destroy', id), {
                onSuccess: () => {
                    window.location = router('tag.index')
                }
            })
        }
    },
}
</script>

<style>
.tag-item {
    padding: 10px;
}

.tag-name {
    font-size: 18px;
}

.tag-name:hover {
    color: blueviolet;
}
</style>