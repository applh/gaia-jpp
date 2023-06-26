import { createSlice } from '@reduxjs/toolkit'

console.log('postSlice.tsx')

// load data from app start
// const response = await fetch('http://localhost:8666/api/scraps')
// const json = await response.json()
// console.log('json', json)
// let items = json

export const postSlice = createSlice({
    name: 'post',
    initialState: {
        value: {
            name: 'post',
            url: '',
            items: [],
        }
    },
    reducers: {
        setItems (state, action) {
            console.log('setItems', action.payload)
            // change userMode
            state.value.items = action.payload
        }
    }
})


export const { setItems } = postSlice.actions

export interface IPostState {
    post: {
        value: {
            name: string,
            url: string,
            items: Array<any>
        }
    }
}

export default postSlice.reducer
