<template>
    <div class="mt-6 flex flex-wrap">
        <template v-for="(link, key) in links">
            <div
                v-if="!link.url"
                :key="key"
                class="mr-1 mb-1 px-4 py-3 text-xs btn btn-xs btn-default"
            >
                {{ link.label }}
            </div>
            <inertia-link
                v-else
                :key="key"
                class="mr-1 mb-1 px-4 py-3 text-xs btn btn-xs"
                :class="{ 'btn-primary': link.active }"
                :href="link.url"
            >
                {{ link.label }}
            </inertia-link>
        </template>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            links: Array
        }
    };
</script>
