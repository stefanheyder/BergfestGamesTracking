<template>
    <tr>
        <td> {{ place }} </td>
        <td> {{ name }} </td>
        <td> {{ totalPoints }}</td>
        <td v-for="lift in kdkLifts">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td :class="{maxLift : kdkTotal === maxLifts.kdk}"> {{kdkTotal}}</td>
        <td> {{ kdkPoints }}</td>
        <td v-for="lift in strongLifts">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td :class="{maxLift : strongTotal === maxLifts.strong}"> {{strongTotal}}</td>
        <td> {{ strongPoints }}</td>
    </tr>

</template>

<script>
    export default {
        props: ['name', 'lifts', 'kdkPoints', 'strongPoints', 'maxLifts', 'femaleLifts', 'kdkTotal', 'strongTotal', 'place'],
        computed: {
            kdkLifts() {
                return ['Squat', 'BenchPress', 'Deadlift'];
            },
            strongLifts() {
                return ['AtlasStone', 'FarmerWalk', 'TireFlip'];
            },
            totalPoints() {
                return this.kdkPoints + this.strongPoints;
            }
        }
    }
</script>

<style>
    .maxLift {
        font-size: 1.2em;
        color: red;
    }
</style>