import { handleActions } from 'redux-actions';
import * as Actions from '../constants/actions';

const initialState: BergfestGamesState = {
	teams: []
};

export default handleActions<BergfestGamesState, { team: Team }>({
	[Actions.ADD_TEAM]: (state, action) => {
		return {
			teams: state.teams.concat(action.payload.team)
		}
	},
	[Actions.ADD_LIFT]: (state, action) => {

	}
}, initialState);
