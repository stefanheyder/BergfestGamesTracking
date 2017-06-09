<template>
    <tr>
        <td class="divide-table event"> {{ place }} </td>
        <td class="event"> {{ name }} </td>
        <td class="divide-table event"> {{ totalPoints }}</td>
        <td v-for="lift in kdkLifts" class="kraftdreikampf">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td :class="{best : kdkTotal === maxLifts.kdk[0], second: kdkTotal === maxLifts.kdk[1], third: kdkTotal === maxLifts.kdk[2]}" class="kraftdreikampf"> {{kdkTotal}}</td>
        <td class="divide-table kraftdreikampf"> {{ kdkPoints }}</td>
        <td v-for="lift in strongLifts" class="strongman">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td :class="{best : strongTotal === maxLifts.strong[0], second: strongTotal === maxLifts.strong[1], third: strongTotal === maxLifts.strong[2]}" class="strongman"> {{strongTotal}}</td>
        <td class="strongman"> {{ strongPoints }}</td>
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
    .best {
        color: #324F17;
    }
    .second {
        color: #3E5726;
    }
    .third {
        color: #4A5B3A;
    }
    .divide-table {
        border-right: solid 1px;
    }
</style>