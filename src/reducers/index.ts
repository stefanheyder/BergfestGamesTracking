import { combineReducers, Reducer } from 'redux';
import games from './bergfestgames';

export default combineReducers<BergfestGamesState>({
	games
});
