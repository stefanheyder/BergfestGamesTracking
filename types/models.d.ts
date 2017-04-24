declare interface Team {
	barbellLifts: Array<BarbellLift>;
	strongmanLifts: Array<StrongManLift>;
}

declare interface Person {
	name: string;
	gender: Gender;
}

declare interface ILift {
	person: Person;
}

declare interface BarbellLift extends ILift {
	type: 'BenchPress' | 'Squat' | 'Deadlift';
	weight: number;
}

declare interface StrongManLift extends ILift{
	type: 'AtlasStone' | 'FarmerWalk' | 'TireFlip';
	amount: number;
}

declare type Gender = 'male' | 'female';

declare interface BergfestGamesState  {
	teams: Array<Team>;
}
