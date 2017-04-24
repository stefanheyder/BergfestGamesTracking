import * as React from "react";
import { RouteComponentProps } from "react-router";
import { connect } from "react-redux";
import { addTeam } from "../../constants/actions";

const mapStateToProps = (state) => ({});
const mapDispatchToProps = (dispatch) => ({
	addTeam: (teamName: string) => dispatch(addTeam(teamName))
});

export interface ConfiguratorProps extends RouteComponentProps<void> {
	addTeam: typeof addTeam;
}

@connect(mapStateToProps, mapDispatchToProps)
export class AddTeam extends React.Component<ConfiguratorProps, { teamname: string }> {

	constructor() {
		super();
		this.state = {teamname: ''};
		this.handleClick = this.handleClick.bind(this);
		this.handleChange = this.handleChange.bind(this);
	}

	handleClick() {
		this.props.addTeam(this.state.teamname);
		this.setState({teamname: ''});
	}

	handleChange(event) {
		this.setState({teamname: event.target.value});
	}

	render() {
		return (
			<div>
				<label>
					TeamName
				 	<input type="text" value={this.state.teamname} onChange={this.handleChange}/>
				</label>
				<button onClick={this.handleClick}>Add Team</button>
			</div>
		);
	}
}

