<template>
    <tr>
        <td> {{ place }} </td>
        <td>
            {{ name }} [{{kdkPoints + strongPoints}}]
        </td>
        <td :class="{maxLift : kdkTotal === maxLifts.kdk}"> {{ kdkPoints }} [{{kdkTotal}}]</td>
        <td :class="{maxLift : strongTotal === maxLifts.strong}"> {{ strongPoints }} [{{strongTotal}}] </td>
        <td v-for="lift in liftTypes">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />

        </td>
    </tr>

</template>

<script>
    export default {
        props: ['name', 'lifts', 'kdkPoints', 'strongPoints', 'maxLifts', 'femaleLifts', 'kdkTotal', 'strongTotal', 'place'],
        computed: {
            liftTypes() {
                return [
                    'Squat',
                    'BenchPress',
                    'Deadlift',
                    'AtlasStone',
                    'FarmerWalk',
                    'TireFlip'
                ]
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