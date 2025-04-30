<template>
    <card :class="cardStyle">
        <h2
            v-if="card.title"
            class="font-bold pb-2 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700"
            v-html="card.title"
        />

        <div v-if="card.height === 'fixed'" :class="fixedStyle">
            <div :class="fixedInnerStyle">
                <div v-html="card.content"></div>
            </div>
        </div>

        <div v-if="card.height === 'dynamic'" v-html="card.content"></div>
    </card>
</template>

<script>
export default {
    props: {
        card: {
            type: Object,
            required: true,
        },
    },

    computed: {
        cardStyle() {
            return this.card.center
                ? 'flex flex-col items-center justify-center py-4 nova-html-card'
                : 'px-6 py-4 nova-html-card';
        },
        fixedStyle() {
            return this.card.title ? 'min-h-[90px]' : 'min-h-[128px]';
        },
        fixedInnerStyle() {
            return this.card.title
                ? 'overflow-hidden overflow-y-auto fixed-html-card max-h-[90px]'
                : 'overflow-hidden overflow-y-auto fixed-html-card max-h-[128px]';
        },
    },
};
</script>
