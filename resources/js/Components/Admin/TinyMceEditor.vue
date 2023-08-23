<template>
     <Editor v-model="content" api-key='w1fk78yropz86guwwh1prc72x5zapin76mtx7zi0ekk21rms' :init="{ /* your other settings */ }"/>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    components: {
        Editor
    },
    data() {
        return {
            content: '',
            
        }
    },
}
</script>