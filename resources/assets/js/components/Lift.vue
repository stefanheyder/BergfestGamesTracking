<template>
    <div :class="{maxLift: isMax}">
        {{ amount }}
    </div>
</template>

<script>
    export default {
        props: ['amount', 'type', 'maxLifts'],
        computed: {
            isMax() {
                return this.amount === this.maxLifts[this.type];
            }
        }
    };
</script>

<style>
    .maxLift {
        background-color: deepskyblue;
    }
</style>
