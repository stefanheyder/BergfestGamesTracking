import { handleActions } from 'redux-actions';
import * as Actions from '../constants/actions';

const initialState: BergfestGamesState = {
	teams: []
};

export default handleActions<BergfestGamesState, any>({
	[Actions.ADD_TEAM]: (state, action) => {
		return {
			teams: state.teams.concat(action.payload)
		}
	},
	[Actions.UPDATE_BARBELL_LIFT]: (state, action) => {
		const teamIndex = state.teams.findIndex(team => team.name === action.payload.teamName);
		const team = state.teams.find(team => team.name === action.payload.teamName);
		
		if (!team) {
			return state;
		}
		
		const previousLift = team.barbellLifts[action.payload.liftname];
		
		if (action.payload.amount <= previousLift.amount) {
			return state;
		}
		
		const newLift = {...previousLift, amount: action.payload.amount};

		const updatedTeam = {...team, barbellLifts: {...team.barbellLifts, [action.payload.liftname]: newLift}};
		
		return {
			...state,
			teams: state.teams.slice(0).splice(teamIndex,1, updatedTeam)
		}
	},
	[Actions.UPDATE_STRONGMAN_LIFT]: (state, action) => {
		const teamIndex = state.teams.findIndex(team => team.name === action.payload.teamName);
		const team = state.teams.find(team => team.name === action.payload.teamName);

		if (!team) {
			return state;
		}

		const previousLift = team.strongmanLifts[action.payload.liftname];

		if (action.payload.amount <= previousLift.amount) {
			return state;
		}

		const newLift = {...previousLift, amount: action.payload.amount};

		const updatedTeam = {...team, strongmanLifts: {...team.strongmanLifts, [action.payload.liftname]: newLift}};

		return {
			...state,
			teams: state.teams.slice(0).splice(teamIndex,1, updatedTeam)
		}
	}
}, initialState);
