<template>
    <button
        v-tooltip="{ content: content, html: true, popperClass: 'max-w-80' }"
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
            class="text-slate-800 dark:text-white opacity-30 transition-opacity group-hover:opacity-50 group-focus-visible:opacity-50 size-4!"
        >
            <path
                fill="currentColor"
                d="M8 16c-4.406 0-8-3.594-8-8s3.594-8 8-8 8 3.594 8 8-3.594 8-8 8M8 5.5c.563 0 1 .438 1 1 0 .438-.219.75-.562.969s-.688.312-1.063.437c-.031 0-.094 0-.125.032v1.75h1.5V9a3.5 3.5 0 0 0 .563-.312C9.875 8.312 10.5 7.594 10.5 6.5 10.5 5.125 9.375 4 8 4a2.507 2.507 0 0 0-2.5 2.5H7c0-.562.438-1 1-1m-.75 5.25v1.5h1.5v-1.5z"
            />
        </svg>
    </button>
</template>

<script>
export default {
    props: {
        content: {
            type: String,
            required: true,
        },
    },
};
</script>
