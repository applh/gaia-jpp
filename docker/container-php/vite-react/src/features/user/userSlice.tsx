import { createSlice } from '@reduxjs/toolkit'

console.log('userSlice.tsx')

export const userSlice = createSlice({
    name: 'user',
    initialState: {
        value: {
            name: 'hello',
            userMode: 'login'
        }
    },
    reducers: {
        login: (state, action) => {
            state.value = action.payload
        },
        logout: (state) => {
            console.log('logout', state.value)
            state.value.name = ''
            state.value.userMode = 'login'
        },
        setUserMode (state, action) {
            console.log('setUserMode', action.payload)
            // change userMode
            state.value.userMode = action.payload
        }
    }
})



export const { login, logout, setUserMode } = userSlice.actions

export interface IUserState {
    user: {
        value: {
            name: string,
            userMode: string
        }
    }
}

export default userSlice.reducer
