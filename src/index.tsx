import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { Router, Route, Switch } from 'react-router';
import { createBrowserHistory } from 'history';
import { configureStore } from './store';
import { App } from './containers/App';
import { AddTeam } from "./containers/Configurator";
import { UpdateLift } from "./containers/UpdateLift";
import { addTeam } from "./constants/actions";


const store = configureStore({teams: []});
const history = createBrowserHistory();

const Root = (props) => (
	<div style={{display:'flex'}} {...props}/>
)

ReactDOM.render(
	<Provider store={store}>
		<Router history={history}>
			<Root>
				<Route path="/" component={App}/>
				<Route path="/" component={AddTeam}/>
				<Route path="/" component={UpdateLift}/>
			</Root>
		</Router>
	</Provider>,
	document.getElementById('root')
);


store.dispatch(addTeam(
	'My Team'
));
store.dispatch(addTeam(
	'My other Team'
));
