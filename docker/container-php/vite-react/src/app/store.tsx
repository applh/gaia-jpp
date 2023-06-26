import { configureStore } from '@reduxjs/toolkit'
import counterReducer from '../features/counter/counterSlice'
import { logAndAdd } from '../features/counter/counterSlice'

import treeReducer from '../features/tree/treeSlice'
import userReducer from '../features/user/userSlice'

const store = configureStore({
    reducer: {
        counter: counterReducer,
        tree: treeReducer,
        user: userReducer,
    },
})

// call action creator once now (sync)
store.dispatch(logAndAdd(5))

export default store