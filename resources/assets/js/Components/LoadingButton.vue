<template>
     <button :disabled="loading" class="btn btn-sm btn-relief-primary"><i class="material-icons">{{ icon }}</i>
        <div v-if="loading" class="btn-spinner mr-1 float-left" />
        <slot />
     </button>
</template>

<script>
    export default {
        props: {
            loading: Boolean,
            icon: String
        },
    };
</script>
