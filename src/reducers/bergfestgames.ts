import ActionTypes from "../constants/actions";

const gamesActions: ReducerMap<typeof ActionTypes, BergfestGamesState> = {
	ADD_TEAM: (state, action) => {
		return {
			teams: state.teams.concat(action.payload)
		}
	},
	UPDATE_BARBELL_LIFT: (state, action) => {
		const teamIndex = state.teams.findIndex(team => team.name === action.payload.teamName);
		const team = state.teams.find(team => team.name === action.payload.teamName);
		
		if (!team) {
			return state;
		}
		
		const previousLift = team.barbellLifts[action.payload.lift];
		
		if (action.payload.amount <= previousLift.amount) {
			return state;
		}
		
		const newLift = {...previousLift, amount: action.payload.amount};

		const updatedTeam = {...team, barbellLifts: {...team.barbellLifts, [action.payload.lift]: newLift}};

		return {
			...state,
			teams: [...state.teams.slice(0, teamIndex), updatedTeam, ...state.teams.slice(teamIndex + 1)]
		}
	},
	UPDATE_STRONGMAN_LIFT: (state, action) => {
		const teamIndex = state.teams.findIndex(team => team.name === action.payload.teamName);
		const team = state.teams.find(team => team.name === action.payload.teamName);

		if (!team) {
			return state;
		}

		const previousLift = team.strongmanLifts[action.payload.lift];

		if (action.payload.amount <= previousLift.amount) {
			return state;
		}

		const newLift = {...previousLift, amount: action.payload.amount};

		const updatedTeam = {...team, strongmanLifts: {...team.strongmanLifts, [action.payload.lift]: newLift}};

		return {
			...state,
			teams: [...state.teams.slice(0, teamIndex), updatedTeam, ...state.teams.slice(teamIndex + 1)]
		}
	}
};

export default function main(state: BergfestGamesState = {teams: []} as any, action: any) {
	if (ActionTypes[action.type]) {
		return gamesActions[action.type](state, action);
	}

	return state;
}

