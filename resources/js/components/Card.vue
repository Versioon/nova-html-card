<template>
    <card :class="cardStyle">
        <div
            v-if="card.title || card.tooltip"
            class="flex items-center gap-2 pb-2 border-b border-gray-200 dark:border-gray-700"
        >
            <h2 v-if="card.title" class="font-bold flex items-center gap-2" v-html="card.title" />

            <button
                v-if="card.tooltip"
                v-tooltip="{ content: card.tooltip, html: true }"
                type="button"
                class="group inline-flex items-center cursor-help focus:outline-none"
                :aria-label="__('More information')"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="none"
                    viewBox="0 0 16 16"
                    class="text-slate-800 dark:text-white opacity-30 transition-opacity group-hover:opacity-50 group-focus-visible:opacity-50"
                >
                    <path
                        fill="currentColor"
                        d="M8 16c-4.406 0-8-3.594-8-8s3.594-8 8-8 8 3.594 8 8-3.594 8-8 8M8 5.5c.563 0 1 .438 1 1 0 .438-.219.75-.562.969s-.688.312-1.063.437c-.031 0-.094 0-.125.032v1.75h1.5V9a3.5 3.5 0 0 0 .563-.312C9.875 8.312 10.5 7.594 10.5 6.5 10.5 5.125 9.375 4 8 4a2.507 2.507 0 0 0-2.5 2.5H7c0-.562.438-1 1-1m-.75 5.25v1.5h1.5v-1.5z"
                    />
                </svg>
            </button>
        </div>

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
