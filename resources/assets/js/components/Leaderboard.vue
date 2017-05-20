<template>
    <div class="container-fluid">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td> Platz </td>
                        <td> Name [Totale Punkte] </td>
                        <td> Punkte KDK [Total KDK]</td>
                        <td> Punkte Strong [Total Strong]</td>
                        <td> Squat </td>
                        <td> BenchPress </td>
                        <td> Deadlift </td>
                        <td> Atlas Stone </td>
                        <td> Farmer Walk </td>
                        <td> Tire Flip </td>
                    </tr>
                </thead>
                <tbody>
                    <team-standings v-for="team in sortedTeams"
                                    :key="team.name"
                                    :name="team.name"
                                    :lifts="team.lifts"
                                    :kdkPoints="team.kdkPoints"
                                    :strongPoints="team.strongPoints"
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
                let strongRanking = _.orderBy(this.teams, this.strongTotal);

                let kdkPoints = team => _.findIndex(this.kdkRanking, team);
                let strongPoints = team => _.findIndex(strongRanking, team);

                _.orderBy(this.teams, this.kdkTotal, 'desc').forEach((team, index, array) => {
                    team.kdkPoints = array.length - index;
                    if (index > 0) {
                        let previous = array[index - 1];
                        if (this.kdkTotal(team) === this.kdkTotal(previous)) {
                            team.kdkPoints = previous.kdkPoints;
                        }
                    }
                })
                _.orderBy(this.teams, this.strongTotal, 'desc').forEach((team, index, array) => {
                    team.strongPoints = array.length - index;
                    if (index > 0) {
                        let previous = array[index - 1];
                        if (this.strongTotal(team) === this.strongTotal(previous)) {
                            team.strongPoints = previous.strongPoints;
                        }
                    }
                })
                let orderedTeams = _.orderBy(this.teams, team => kdkPoints(team) + strongPoints(team), 'desc');
                return orderedTeams;
            },
            kdkRanking() {
                return _.orderBy(this.teams, this.kdkTotal);
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
            place(team) {
                return this.sortedTeams().map(team => team);
            }
        },
        methods: {
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
