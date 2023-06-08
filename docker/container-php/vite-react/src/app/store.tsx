import { configureStore } from '@reduxjs/toolkit'
import counterReducer from '../features/counter/counterSlice'
import { logAndAdd } from '../features/counter/counterSlice'

import treeReducer from '../features/tree/treeSlice'

const store = configureStore({
    reducer: {
        counter: counterReducer,
        tree: treeReducer,
    },
})

// call action creator once now (sync)
store.dispatch(logAndAdd(5))

export default store