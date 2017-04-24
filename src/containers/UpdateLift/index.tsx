import * as React from "react";
import { RouteComponentProps } from "react-router";
import { connect } from "react-redux";
import { addTeam, updateBarbelllift } from "../../constants/actions";

const mapStateToProps = (state) => ({
	teams: state.games.teams.map(team => team.name)
});
const mapDispatchToProps = (dispatch) => ({
	updateLift: (teamname, name, amount) => dispatch(updateBarbelllift(teamname, name, amount))
});

export interface UpdateLiftProps extends RouteComponentProps<void> {
	updateLift: typeof updateBarbelllift;
	teams: Array<string>
}

export interface UpdateLiftState {
	lift: string,
	amount: number
	teamname: string
}

const initialState = {lift: 'BenchPress', amount: 0, teamname: ''};

@connect(mapStateToProps, mapDispatchToProps)
export class UpdateLift extends React.Component<UpdateLiftProps, UpdateLiftState> {

	constructor(props) {
		super();
		this.state = {...initialState, teamname: props.teams[0]};
		this.handleClick = this.handleClick.bind(this);
		this.handleTeamChange = this.handleTeamChange.bind(this);
		this.handleLiftChange = this.handleLiftChange.bind(this);
		this.handleAmountChange = this.handleAmountChange.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);

	}

	handleClick() {

		this.setState({...initialState});
	}

	handleLiftChange(event) {
		this.setState({...this.state, lift: event.target.value});
	}

	handleTeamChange(event) {
		this.setState({...this.state, teamname: event.target.value});
	}

	handleAmountChange(event) {
		this.setState({...this.state, amount: event.target.value});
	}

	handleSubmit(event) {
		this.props.updateLift(this.state.teamname, this.state.lift, this.state.amount);
	}

	render() {
		return (
			<div>
				<label>
					Lift
					<select value={this.state.lift} onChange={this.handleLiftChange}>
						<option value="BenchPress">BenchPress</option>
						<option value="Deadlift">Deadlift</option>
						<option value="Squat">Squat</option>
					</select>
					<select value={this.state.teamname} onChange={this.handleTeamChange}>
						{this.props.teams.map(team => {return <option value={team}>{team}</option>})}
					</select>
					<input type="text" value={this.state.amount} onChange={this.handleAmountChange}/>
				</label>
				<button onClick={this.handleSubmit}>Absenden</button>
			</div>
		);
	}
}
