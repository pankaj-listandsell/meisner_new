<template>
    <div class="form-error" v-if="!isEmptyObject(error)">
        <div class="form-error-item" v-for="error in error.errors">
            {{ error }}
        </div>
    </div>
</template>

<script>

export default {

    props: {
        error: {
            type: Object,
            required: true
        },
    },

    methods: {

        isEmptyObject(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        }

    },


}
</script>

<style>
</style>
