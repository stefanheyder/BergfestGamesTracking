<template>
    <div >
        <div :class="{femaleLift: female}" >{{ displayAmount }}</div>
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
                return `${this.amount}${this.female ? '(x3)' : ''}`;
            }
        }
    };
</script>

<style>
    .maxLift {
        font-size: 1.2em;
        color: red;
    }
    .femaleLift {
        background-color: rgba(80,130,200, 0.5);
        border-radius: 8px;
    }
</style>
