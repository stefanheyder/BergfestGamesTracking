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
