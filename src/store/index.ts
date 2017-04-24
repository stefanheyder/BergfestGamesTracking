import { createStore, applyMiddleware, Store } from 'redux';
import { logger } from '../middleware';
import rootReducer from '../reducers';

export function configureStore(initialState?: BergfestGamesState): Store<CompleteState> {
  const create = window.devToolsExtension
    ? window.devToolsExtension()(createStore)
    : createStore;

  const createStoreWithMiddleware = applyMiddleware(logger)(create);

  const store = createStoreWithMiddleware(rootReducer, {games: {teams: []}}) as Store<CompleteState>;

  if (module.hot) {
    module.hot.accept('../reducers', () => {
      const nextReducer = require('../reducers');
      store.replaceReducer(nextReducer);
    });
  }

  return store;
}
