import { Suspense, lazy, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'

// lazy
const PostList = lazy(() => import('../post/PostList'))

// redux store
import { userSelect, logout } from './userSlice'

// warning: components must be defined as default export
const AdminDashboard = lazy(() => import('./AdminDashboard'))
const AdminCrud = lazy(() => import('./AdminCrud'))

export default function Admin () {

    const [ choice, setChoice ] = useState('dashboard')

    const act_change = function (event: React.ChangeEvent<HTMLElement>) {
        const user_choice = event.currentTarget.getAttribute('value') as string
        console.log('act_change', user_choice, event)
        // reactivity
        setChoice(user_choice)
    }
    
    // react redux
    const dispatch = useDispatch()
    const user = useSelector(userSelect)

    const act_logout = function (event: React.MouseEvent<HTMLElement>) {
        console.log('act_logout', event)
        dispatch(logout())
    }

    let panel = <AdminDashboard />
    if (choice === 'crud') panel = <AdminCrud />

    return (
        <div>
            <h1>Admin ({ user.name})</h1>
            <label>
                <input type="radio" name="adminPanel" value="dashboard" checked={choice === 'dashboard'} onChange={act_change} />
                <span>Dashboard</span>
            </label>
            <label>
                <input type="radio" name="adminPanel" value="crud" onChange={act_change} />
                <span>Crud</span>
            </label>
            <label>
                <button onClick={act_logout}>Logout</button>
            </label>
            <h2>{ choice }</h2>
            <PostList />
            <Suspense>
                { panel }
            </Suspense>
        </div> 
    )
}
