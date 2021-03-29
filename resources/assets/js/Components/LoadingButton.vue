<template>
     <mdb-btn :disabled="loading" outline="primary" size="sm" class="BotonEstilo"><mdb-icon :icon="icon"/> 
        <div v-if="loading" class="btn-spinner mr-2 float-left" />
        <slot />
     </mdb-btn>
</template>

<script>
    import { mdbIcon,mdbBtn } from "mdbvue";
    export default {
        components: {
            mdbIcon,
            mdbBtn
        },
        props: {
            loading: Boolean,
            icon: String
        },
    };
</script>
