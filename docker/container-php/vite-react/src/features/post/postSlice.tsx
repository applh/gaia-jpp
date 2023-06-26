import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

// HACK: strange loop a store.tsx is also importing this file
import { RootState } from '../../app/store'

console.log('postSlice.tsx')

// load data from app start
// const response = await fetch('http://localhost:8666/api/scraps')
// const json = await response.json()
// console.log('json', json)
// let items = json

import myConfig from '../my-config/config'

// https://redux-toolkit.js.org/api/createAsyncThunk
// quite complicated as lot of codes must be inserted in different places
export const fetchItems = createAsyncThunk(
    'post/fetchItems',
    async () => {
        console.log('fetchItems')
        const response = await fetch(myConfig.api.url)
        const json = await response.json()
        return json;
    }
)

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
    },
    // dynamic reducers are possible 😎
    extraReducers: (builder) => {
        builder.addCase(fetchItems.pending, (state: any, action) => {
            console.log('fetchItems.pending', action, state)
        })
        builder.addCase(fetchItems.fulfilled, (state: any, action) => {
            console.log('fetchItems.fulfilled', action, state)
            // action.payload is the return value of the async thunk
            state.value.items = action.payload
        })
        builder.addCase(fetchItems.rejected, (state: any, action) => {
            console.log('fetchItems.rejected', action, state)
        })
    }
})

export const { setItems } = postSlice.actions

// export interface IPostState {
//     post: {
//         value: {
//             name: string,
//             url: string,
//             items: Array<any>
//         }
//     }
// }

// helper: define useSelector callback here
export const postSelect = (state: RootState) => {
    console.log('post', state)
    return state.post.value
}

export default postSlice.reducer
