import { configureStore } from '@reduxjs/toolkit'
import { useDispatch } from 'react-redux'

import counterReducer from '../features/counter/counterSlice'
import { logAndAdd } from '../features/counter/counterSlice'

import treeReducer from '../features/tree/treeSlice'
import userReducer from '../features/user/userSlice'
import postReducer from '../features/post/postSlice'

const store = configureStore({
    reducer: {
        counter: counterReducer,
        tree: treeReducer,
        user: userReducer,
        post: postReducer
    },
})

// call action creator once now (sync)
store.dispatch(logAndAdd(5))

export default store

// TS helpers
// https://redux-toolkit.js.org/usage/usage-with-typescript
export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
export const useAppDispatch: () => AppDispatch = useDispatch // Export a hook that can be reused to resolve types
