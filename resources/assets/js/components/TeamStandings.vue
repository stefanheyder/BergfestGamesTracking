<template>
    <tr>
        <td>
            {{ name }} [{{kdkPoints + strongPoints}}]
        </td>
        <td> {{ kdkPoints }}</td>
        <td> {{ strongPoints }}</td>
        <td v-for="lift in liftTypes">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
            />
        </td>
    </tr>

</template>

<script>
    export default {
        props: ['name', 'lifts', 'kdkPoints', 'strongPoints', 'maxLifts'],
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