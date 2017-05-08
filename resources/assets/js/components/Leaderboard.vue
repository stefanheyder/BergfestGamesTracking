<template>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <td> Name [Totale Punkte] </td>
                        <td> Punkte KDK</td>
                        <td> Punkte Strong</td>
                        <td> Squat </td>
                        <td> BenchPress </td>
                        <td> Deadlift </td>
                        <td> Atlas Stone </td>
                        <td> Tire Flip </td>
                        <td> Farmer Walk </td>
                    </tr>
                </thead>
                <tbody>
                    <team-standings v-for="team in sortedTeams"
                                    :name="team.name"
                                    :lifts="team.lifts"
                                    :kdkPoints="team.kdkPoints"
                                    :strongPoints="team.strongPoints"
                                    :maxLifts="maxLifts"
                    />
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                teams: []
            }
        },
        created() {
            let updateTeams = () => axios.get(`/lifts`)
                .then(response => this.teams = response.data);
            updateTeams();
            setInterval(updateTeams, 10000);
        },
        computed: {
            sortedTeams() {
                let sumLifts = lifts => _.sum(_.values(lifts));
                let kdkLifts = team => _.pick(team.lifts, ['Squat', 'Deadlift', 'BenchPress']);
                let kdkTotal = team => sumLifts(kdkLifts(team));

                let strongLifts = team => _.pick(team.lifts, ['AtlasStone', 'TireFlip', 'FarmerWalk']);
                let strongTotal = team => sumLifts(strongLifts(team));

                let kdkRanking = _.orderBy(this.teams, kdkTotal);
                let strongRanking = _.orderBy(this.teams, strongTotal);

                let kdkPoints = team => _.findIndex(kdkRanking, team);
                let strongPoints = team => _.findIndex(strongRanking, team);

                this.teams = this.teams.map(team => {
                    team.kdkPoints = kdkPoints(team);
                    team.strongPoints = strongPoints(team);
                    return team;
                })

                return _.orderBy(this.teams, team => kdkPoints(team) + strongPoints(team), 'desc');
            },
            maxLifts() {


                return {
                    'BenchPress': _.max(this.teams.map(team => team.lifts.BenchPress)),
                    'Squat': _.max(this.teams.map(team => team.lifts.Squat)),
                    'Deadlift': _.max(this.teams.map(team => team.lifts.Deadlift)),
                }
            }

        }
    }
</script>
