import { createSlice } from '@reduxjs/toolkit'
// HACK: strange loop a store.tsx is also importing this file
import { RootState } from '../../app/store'

console.log('userSlice.tsx')

export const userSlice = createSlice({
    name: 'user',
    initialState: {
        value: {
            name: 'hello',
            role: 'guest',
            userMode: 'login',
            userInfos: {},
            form_login: {
                email: 'test@toto.com',
                password: '1234'
            }
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
        },
        setLoginEmail (state, action) {
            state.value.form_login.email = action.payload
        },
        setLoginPassword (state, action) {
            state.value.form_login.password = action.payload
        },
        setUserInfos (state, action) {
            console.log('setUserInfos', action.payload)
            state.value.userInfos = action.payload
            state.value.role = action.payload.role
        }
    }
})

export const { login, logout, setUserMode, setLoginEmail, setLoginPassword, setUserInfos } = userSlice.actions

// helper: define useSelector callback here
export const userSelect = (state: RootState) => {
    console.log('user', state)
    return state.user.value
}


export default userSlice.reducer
