<template>
    <div class="container-fluid">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center"> Platz </th>
                        <th rowspan="2" class="text-center"> Name </th>
                        <th rowspan="2" class="text-center"> Punkte </th>
                        <th colspan="5" class="text-center"> Kraftdreikampf </th>
                        <th colspan="5" class="text-center"> Strongman </th>
                    </tr>
                    <tr>
                        <th class="text-center"> Squat </th>
                        <th class="text-center"> BenchPress </th>
                        <th class="text-center"> Deadlift </th>
                        <th class="text-center"> Total </th>
                        <th class="text-center"> Punkte</th>
                        <th class="text-center"> Atlas Stone </th>
                        <th class="text-center"> Farmer Walk </th>
                        <th class="text-center"> Tire Flip </th>
                        <th class="text-center"> Total </th>
                        <th class="text-center"> Punkte </th>
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
    </div>
</template>

<script>
    const femaleMultiplier = 2;
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
                    'BenchPress': _.max(this.teams.map(team => team.lifts.BenchPress)),
                    'Squat': _.max(this.teams.map(team => team.lifts.Squat)),
                    'Deadlift': _.max(this.teams.map(team => team.lifts.Deadlift)),
                    'AtlasStone': _.max(this.teams.map(team => team.lifts.AtlasStone)),
                    'TireFlip': _.max(this.teams.map(team => team.lifts.TireFlip)),
                    'FarmerWalk': _.max(this.teams.map(team => team.lifts.FarmerWalk)),
                    'kdk': _.max(this.teams.map(this.kdkTotal)),
                    'strong': _.max(this.teams.map(this.strongTotal))
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
                return _.mapValues(_.pick(team.lifts, ['AtlasStone', 'TireFlip', 'FarmerWalk']), (value, key) => {
                    let isFemaleLift = _.includes(team.femaleLifts, key);
                    return isFemaleLift ? femaleMultiplier * value : value;
                });
            },
            strongTotal (team) {
                return this.sumLifts(this.strongLifts(team));
            }

        }

    }
</script>

<style>
    table tr:nth-child(1) td {
        background-color: gold;
    }
    table tr:nth-child(2) td {
        background-color: silver;
    }
    table tr:nth-child(3) td {
        background-color: #CD7F32;
    }
</style>
