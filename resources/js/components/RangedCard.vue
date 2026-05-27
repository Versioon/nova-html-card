<template>
    <loading-card :class="cardStyle" :loading="loading">
        <div
            v-if="card.title || card.tooltip || card.ranges.length > 0"
            class="flex border-b border-gray-200 dark:border-gray-700 items-center gap-2 pb-2"
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

            <SelectControl
                v-if="card.ranges.length > 0"
                :value="selectedRangeKey"
                @update:modelValue="handleRangeSelected"
                :options="card.ranges"
                size="xxs"
                class="ml-auto w-[6rem] shrink-0"
                :aria-label="__('Select Ranges')"
            />
        </div>
        <div v-if="card.height === 'fixed'" :class="fixedStyle">
            <div :class="fixedInnerStyle">
                <div v-html="card.content"></div>
            </div>
        </div>

        <div v-if="card.height === 'dynamic'" v-html="card.content"></div>
    </loading-card>
</template>

<script>
import { MetricBehavior } from 'laravel-nova';

export default {
    mixins: [MetricBehavior],

    data() {
        return {
            loading: false,
            selectedRangeKey: null,
        };
    },

    props: {
        card: {
            type: Object,
            required: true,
        },
    },

    created() {
        if (this.hasRanges) {
            this.selectedRangeKey = this.card.selectedRangeKey || this.card.ranges[0].value;
        }

        this.fetch();
    },

    mounted() {
        if (this.card && this.card.refreshWhenFiltersChange === true) {
            Nova.$on('filter-changed', this.fetch);
            Nova.$on('filter-reset', this.fetch);
        }
    },

    beforeUnmount() {
        if (this.card && this.card.refreshWhenFiltersChange === true) {
            Nova.$off('filter-changed', this.fetch);
            Nova.$off('filter-reset', this.fetch);
        }
    },

    methods: {
        handleRangeSelected(key) {
            this.selectedRangeKey = key;
            this.fetch();
        },

        handleFetchCallback() {
            return response => {
                this.card.content = response.data.value;
                this.loading = false;
            };
        },
    },

    computed: {
        hasRanges() {
            return this.card.ranges.length > 0;
        },
        cardStyle() {
            return this.card.center
                ? 'flex flex-col items-center justify-center py-4 nova-html-card nova-html-ranged-card'
                : 'px-6 py-4 nova-html-card nova-html-ranged-card';
        },
        fixedStyle() {
            return this.card.title ? 'min-h-[90px]' : 'min-h-[128px]';
        },
        fixedInnerStyle() {
            return this.card.title
                ? 'overflow-hidden overflow-y-auto fixed-html-card max-h-[90px]'
                : 'overflow-hidden overflow-y-auto fixed-html-card max-h-[128px]';
        },
        metricPayload() {
            const payload = {
                params: {
                    range: this.selectedRangeKey,
                    page: this.card.page ?? null,
                    perPage: this.card.perPage ?? null,
                },
            };

            if (!Nova.missingResource(this.resourceName) && this.card && this.card.refreshWhenFiltersChange === true) {
                payload.params.filter = this.$store.getters[`${this.resourceName}/currentEncodedFilters`];
            }

            return payload;
        },
    },
};
</script>
