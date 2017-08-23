<template>
    <tr>
        <td class="divide-table event"> {{ place }} </td>
        <td class="event">
            <div>
                {{ name }}
            </div>
        </td>
        <td class="divide-table event"> {{ totalPoints }}</td>
        <td v-for="lift in kdkLifts" class="kraftdreikampf" style="vertical-align:middle">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td  class="kraftdreikampf" style="vertical-align:middle">
            {{kdkTotal}}
        </td>
        <td class="kraftdreikampf" style="padding-left: 0; padding-right: 0; margin-left: 0; margin-right: 0; vertical-align: middle;">
            <i :class="{best : kdkPlace === 1, second: kdkPlace === 2, third: kdkPlace === 3}"
               class="fa fa-trophy"
               v-show="kdkPlace >= 1 && kdkPlace <=  3"
               style="font-size: 1.3em">
            </i>
        </td>
        <td class="divide-table kraftdreikampf" style="vertical-align:middle"> {{ kdkPoints }}</td>
        <td v-for="lift in strongLifts" class="strongman" style="vertical-align:middle">
            <lift :maxLifts="maxLifts"
                  :amount="lifts[lift]"
                  :type="lift"
                  :female="femaleLifts && femaleLifts.indexOf(lift) !== -1"
            />
        </td>
        <td :class="" class="strongman" style="vertical-align:middle"> {{strongTotal}}</td>
        <td class="strongman" style="padding-left: 0; padding-right: 0; margin-left: 0; margin-right: 0;vertical-align: middle;">
            <i :class="{third: strongPlace === 3, second: strongPlace === 2, best : strongPlace === 1}"
               class="fa fa-trophy"
               v-show="strongPlace >= 1 && strongPlace <= 3"
               style="font-size: 1.3em">
            </i>
        </td>
        <td class="strongman" style="vertical-align:middle"> {{ strongPoints }}</td>
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
                return ['Burpee', 'FarmerWalk', 'TireFlip'];
            },
            totalPoints() {
                return this.kdkPoints + this.strongPoints;
            },
            strongPlace() {
                if (this.strongTotal === 0) {
                    return -1;
                }
                return this.maxLifts.strong.indexOf(this.strongTotal) + 1;
            },
            kdkPlace() {
                if (this.kdkTotal === 0) {
                    return -1;
                }
                return this.maxLifts.kdk.indexOf(this.kdkTotal) + 1;
            }
        }
    }
</script>

<style>
    .best {
        color: gold;
    }
    .second {
        color: silver;
    }
    .third {
        color: #cd7f32;
    }
    .none {
        color: #d0d0d0;
    }
    .divide-table {
        border-right: solid 1px;
    }
</style>