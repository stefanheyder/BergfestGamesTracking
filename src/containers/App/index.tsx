import * as React from "react";
import * as style from "./style.css";
import { connect } from "react-redux";
import { RouteComponentProps } from "react-router";
import { RootState } from "reducers";
import { addTeam } from "../../constants/actions";

export namespace App {
	export interface Props extends RouteComponentProps<void> {
		addTeam: typeof addTeam;
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
		const {children} = this.props;
		return (
			<div className={style.normal}>
				<button onClick={this.handleClick}> My Button</button>
			</div>
		);
	}
}

function mapStateToProps(state: RootState) {
	return {};
}

function mapDispatchToProps(dispatch) {
	return {
		addTeam: (teamName: string) => {dispatch(addTeam(teamName))}
	};
}
