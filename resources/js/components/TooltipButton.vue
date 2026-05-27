<template>
    <button
        v-tooltip="{ content: content, html: true, popperClass: 'nova-html-card-tooltip-popper' }"
        type="button"
        class="nova-html-card-tooltip-button"
        :aria-label="__('More information')"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="none"
            viewBox="0 0 16 16"
            class="nova-html-card-tooltip-icon"
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

<style scoped>
.nova-html-card-tooltip-button {
    display: inline-flex;
    align-items: center;
    padding: 0;
    background: transparent;
    border: 0;
    cursor: help;
}

.nova-html-card-tooltip-button:focus {
    outline: none;
}

.nova-html-card-tooltip-icon {
    width: 16px !important;
    height: 16px !important;
    color: rgb(30 41 59); /* slate-800 */
    opacity: 0.3;
    transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
}

.nova-html-card-tooltip-button:hover .nova-html-card-tooltip-icon,
.nova-html-card-tooltip-button:focus-visible .nova-html-card-tooltip-icon {
    opacity: 0.5;
}

.dark .nova-html-card-tooltip-icon {
    color: rgb(255 255 255);
}
</style>

<style>
/* Tooltip popover is teleported outside the component, so this must be unscoped. */
.nova-html-card-tooltip-popper {
    max-width: 20rem;
}
</style>
