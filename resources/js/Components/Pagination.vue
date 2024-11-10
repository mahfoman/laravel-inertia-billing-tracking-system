<template>
    <div>
    <Component
        v-for="link in links"
        :is="link.url ? 'a' : 'span'"
        :href="link.url"
        v-html="link.label"
        class="px-1"
        :class="{ 'text-grey-500' : ! link.url, 'font-bold' : link.active }"
    />
    </div>
</template>

<script>

export default {
    props: {
        links: Array
    }
}
</script>
