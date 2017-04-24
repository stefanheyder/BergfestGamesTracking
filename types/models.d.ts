declare type KeyMap<keys extends string, Value> = {
	[key in keys]: Value;
}

declare interface Team {
	name: string
	barbellLifts: KeyMap<BarbellLifts, ILift>
	strongmanLifts: KeyMap<StrongManLifts, ILift>
}
declare interface Person {
	name: string;
	gender: Gender;
}

declare interface ILift {
	person?: Person;
	amount: number;
}

declare type BarbellLifts = 'BenchPress' | 'Deadlift' | 'Squat';
declare type StrongManLifts = 'AtlasStone' | 'FarmerWalk' | 'TireFlip';

declare type Gender = 'male' | 'female';

declare interface BergfestGamesState  {
	teams: Array<Team>;
}

declare interface CompleteState {
	games: BergfestGamesState
}

interface IStringMap<T> {
	[key: string]: T;
}

interface IAction extends IStringMap<any> {
	type: string;
}

interface IReducerFunction<State> {
	(currentState: State, action: IAction): State;
}

type ReducerMap<Actions extends object, State> = {
	[key in keyof Actions]: IReducerFunction<State>;
};

