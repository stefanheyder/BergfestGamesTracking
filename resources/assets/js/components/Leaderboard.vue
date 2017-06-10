<template>
    <div class="row" style="font-size:28px;font-family:monospace;font-weight:bold;text-align: center;">
        <table class="table ">
            <thead>
            <tr>
                <th colspan="3" class="text-center divide-table event"> Event </th>
                <th colspan="5" class="text-center kraftdreikampf divide-table"> Kraftdreikampf </th>
                <th colspan="5" class="text-center strongman"> Strongman </th>
            </tr>
            <tr>
                <th class="text-center event divide-table"> Platz </th>
                <th class="text-center event"> Name </th>
                <th class="text-center event divide-table"> Punkte </th>
                <th class="text-center kraftdreikampf"> Beugen </th>
                <th class="text-center kraftdreikampf"> Drücken </th>
                <th class="text-center kraftdreikampf"> Heben </th>
                <th class="text-center kraftdreikampf"> Total </th>
                <th class="text-center divide-table kraftdreikampf"> Punkte</th>
                <th class="text-center strongman"> Burpee </th>
                <th class="text-center strongman"> Walk </th>
                <th class="text-center strongman"> Flip </th>
                <th class="text-center strongman"> Total </th>
                <th class="text-center strongman"> Punkte </th>
            </tr>
            </thead>
            <tbody>
            <team-standings v-for="team in sortedTeams"
                            :key="team.name"
                            :place="place(team)"
                            :name="team.name"
                            :lifts="team.lifts"
                            :kdkPoints="kdkPoints(team)"
                            :strongPoints="strongPoints(team)"
                            :maxLifts="maxLifts"
                            :femaleLifts="team.femaleLifts"
                            :kdkTotal="kdkTotal(team)"
                            :strongTotal="strongTotal(team)"
            />
            </tbody>
        </table>
    </div>
</template>

<script>
    const femaleMultiplier = 3;
    export default {
        data() {
            return {
                teams: []
            }
        },
        created() {
            let updateTeams = () => {
                axios.get(`/lifts`)
                    .then(response => {
                        axios.get('/femaleLifts').then(res => {
                            this.teams = response.data
                            res.data.forEach((data, index) => {

                                let team = this.teams[index];
                                team.femaleLifts = data.lifts;
                            })
                        })
                    });
            }
            updateTeams();
            setInterval(updateTeams, 10000);
        },
        computed: {
            sortedTeams() {
                return _.orderBy(this.teams, this.totalPoints, 'desc');
            },
            maxLifts() {
                return {
                    'kdk': _.uniq(_.orderBy(this.teams.map(this.kdkTotal), _.identity, 'desc')),
                    'strong': _.uniq(_.orderBy(this.teams.map(this.strongTotal), _.identity, 'desc'))
                }
            },
        },
        methods: {
            strongPoints(team) {
                return this.teams.length - _.orderBy(this.teams.map(this.strongTotal), _.identity, 'desc').indexOf(this.strongTotal(team));
            },
            kdkPoints(team) {
                return this.teams.length - _.orderBy(this.teams.map(this.kdkTotal), _.identity, 'desc').indexOf(this.kdkTotal(team));
            },
            totalPoints(team) {
                return this.strongPoints(team) + this.kdkPoints(team);
            },
            place(team) {
                return _.orderBy(this.teams.map(this.totalPoints), _.identity(), 'desc')
                        .indexOf(this.totalPoints(team)) + 1 ;
            },
            sumLifts (lifts) {
                return _.sum(_.values(lifts));
            },
            kdkLifts (team) {
                return _.mapValues(_.pick(team.lifts, ['Squat', 'Deadlift', 'BenchPress']), (value, key) => {
                    let isFemaleLift = _.includes(team.femaleLifts, key);
                    return isFemaleLift ? femaleMultiplier * value : value;
                });
            },
            kdkTotal (team) {
                return this.sumLifts(this.kdkLifts(team));
            },
            strongLifts (team) {
                return _.pick(team.lifts, ['Burpee', 'TireFlip', 'FarmerWalk']);
            },
            strongTotal (team) {
                return this.sumLifts(this.strongLifts(team));
            }
        }
    }
</script>

<style>
    .event {
        background-color: #d8d8d8;
    }
    .kraftdreikampf {
        background-color: #d0d0d0;
    }
    .strongman {
        background-color: #d8d8d8;
    }
</style>
