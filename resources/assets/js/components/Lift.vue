<template>
    <div :class="{maxLift: isMax}">
        <div >{{ displayAmount }}</div>
    </div>
</template>

<script>
    export default {
        props: ['amount', 'type', 'maxLifts', 'female'],
        computed: {
            isMax() {
                return this.amount === this.maxLifts[this.type];
            },
            displayAmount() {
                return `${this.amount}${this.female ? '[f]' : ''}`;
            }
        }
    };
</script>

<style>
    .maxLift {
        font-size: 1.2em;
        color: red;
    }
</style>
