const ActionTypes = {
	ADD_TEAM: 'ADD_TEAM',
	UPDATE_BARBELL_LIFT: 'UPDATE_BARBELL_LIFT',
	UPDATE_STRONGMAN_LIFT: 'UPDATE_STRONGMAN_LIFT',
};

export function addTeam(teamName: string) {

	return {
		type: ActionTypes.ADD_TEAM,
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

export function updateBarbelllift(teamName: string, lift: string, amount: number) {
	return {
		type: ActionTypes.UPDATE_BARBELL_LIFT,
		payload: {
			teamName,
			lift,
			amount
		}
	}
}

export function updateStrongManLift(teamName: string, lift: string, amount: number) {
	return {
		type: ActionTypes.UPDATE_STRONGMAN_LIFT,
		payload: {
			teamName,
			lift,
			amount
		}
	}
}

export default ActionTypes;
