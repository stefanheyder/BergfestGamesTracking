import { combineReducers, Reducer } from 'redux';
import todos from './bergfestgames';

export interface RootState {

}

export default combineReducers<RootState>({
  todos
});
