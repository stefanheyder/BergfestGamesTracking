export const ADD_TEAM = 'ADD_TEAM';
export const UPDATE_BARBELL_LIFT = 'UPDATE_BARBELL_LIFT';
export const UPDATE_STRONGMAN_LIFT = 'UPDATE_STRONGMAN_LIFT';

export function addTeam(teamName: string) {

	return {
		type: ADD_TEAM,
		payload: {
			name: teamName,
			barbellLifts: {
				'BenchPress' :{
					amount: 0
				},
				'Deadlift' :{
					amount: 0
				},
				'Squat' :{
					amount: 0
				}
			},
			strongmanLifts: {
				'AtlasStone': {
					amount: 0
				},
				'FarmerWalk': {
					amount: 0
				},
				'TireFlip': {
					amount: 0
				}
			}
		}
	}
}

export function updateBarbelllift(teamname: string, liftname: string, amount: number) {
	return {
		type: UPDATE_BARBELL_LIFT,
		payload: {
			teamname,
			liftname,
			amount
		}
	}
}

export function updateStrongManLift(teamname: string, liftname: string, amount: number) {
	return {
		type: UPDATE_STRONGMAN_LIFT,
		payload: {
			teamname,
			liftname,
			amount
		}
	}
}
