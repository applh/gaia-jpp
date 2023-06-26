import { createSlice } from '@reduxjs/toolkit'

console.log('counterSlice.tsx')

export const counterSlice = createSlice({
    name: 'counter',
    initialState: {
        value: 0,
    },
    reducers: {
        increment: (state) => {
            // Redux Toolkit allows us to write "mutating" logic in reducers. It
            // doesn't actually mutate the state because it uses the Immer library,
            // which detects changes to a "draft state" and produces a brand new
            // immutable state based off those changes.
            // Also, no return statement is required from these functions.
            state.value += 1
        },
        decrement: (state) => {
            state.value -= 1
        },
        incrementByAmount: (state, action) => {
            state.value += action.payload
        },
    },
})

// Action creators are generated for each case reducer function
export const { increment, decrement, incrementByAmount } = counterSlice.actions

// FIXME: not working ?!
// export type ICounterState = ReturnType<typeof counterSlice.reducer>

export interface ICounterState {
    counter: {
        value: number
    }
}

// can be called sync at mount 
// can be called by dispatch() in components
export const logAndAdd = (amount: number) => {
    return (dispatch: any, getState: any) => {
        const stateBefore = getState()
        console.log(`Counter before: ${stateBefore.counter.value}`)
        
        // modify state
        dispatch(incrementByAmount(amount))

        const stateAfter = getState()
        console.log(`Counter after: ${stateAfter.counter.value}`)
    }
}


export default counterSlice.reducer