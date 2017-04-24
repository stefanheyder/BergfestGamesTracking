import { combineReducers, Reducer } from 'redux';
import todos from './todos';

export interface RootState {

}

export default combineReducers<RootState>({
  todos
});
