import * as React from "react";
import * as style from "./style.css";
import { connect } from "react-redux";
import { RouteComponentProps } from "react-router";
import { addTeam } from "../../constants/actions";
import { BootstrapTable, TableHeaderColumn } from "react-bootstrap-table";

export namespace App {
	export interface Props extends RouteComponentProps<void> {
		addTeam: typeof addTeam;
		teams: Array<Team>;
	}

	export interface State {

	}
}

@connect(mapStateToProps, mapDispatchToProps)
export class App extends React.Component<App.Props, App.State> {

	constructor() {
		super();
		this.handleClick = this.handleClick.bind(this);
	}

	handleClick() {
		this.props.addTeam('myNewTeam');
	}

	render() {
		const data = this.props.teams.map(team => ({
			name: team.name,
			Squat: team.barbellLifts.Squat.amount,
			BenchPress: team.barbellLifts.BenchPress.amount,
			Deadlift: team.barbellLifts.Deadlift.amount,
			AtlasStone: team.strongmanLifts.AtlasStone.amount,
			FarmerWalk: team.strongmanLifts.FarmerWalk.amount,
			TireFlip: team.strongmanLifts.TireFlip.amount,
		}));

		return (
			<BootstrapTable data={data} striped={true} hover={true}>
				<TableHeaderColumn isKey dataField='name'>TeamName</TableHeaderColumn>
				<TableHeaderColumn dataField='Squat'>Kniebeuge</TableHeaderColumn>
				<TableHeaderColumn dataField='BenchPress'>Bankdrücken</TableHeaderColumn>
				<TableHeaderColumn dataField='Deadlift'>Kreuzheben</TableHeaderColumn>
				<TableHeaderColumn ></TableHeaderColumn>
				<TableHeaderColumn dataField='AtlasStone'>Atlas Stone</TableHeaderColumn>
				<TableHeaderColumn dataField='FarmerWalk'>Farmer Walk</TableHeaderColumn>
				<TableHeaderColumn dataField='TireFlip'>TireFlip</TableHeaderColumn>
			</BootstrapTable>
		);
	}
}

function mapStateToProps(state: CompleteState) {
	return {
		teams: state.games.teams || []
	};
}

function mapDispatchToProps(dispatch) {
	return {
		addTeam: (teamName: string) => {dispatch(addTeam(teamName))}
	};
}
