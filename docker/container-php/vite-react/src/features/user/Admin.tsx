import { Suspense, lazy, useState } from 'react'

// warning: components must be defined as default export
const AdminDashboard = lazy(() => import('./AdminDashboard'))
const AdminCrud = lazy(() => import('./AdminCrud'))

export function Admin () {

    const [ choice, setChoice ] = useState('dashboard')

    const act_click = function (event: React.MouseEvent<HTMLElement>) {
        const user_choice = event.currentTarget.getAttribute('value') as string
        console.log('click', user_choice, event)
        // reactivity
        setChoice(user_choice)
    }
    
    let panel = <AdminDashboard />
    if (choice === 'crud') panel = <AdminCrud />

    return (
        <div>
            <h1>Admin</h1>
            <label>
                <input type="radio" name="user" value="dashboard" checked={choice === 'dashboard'} onClick={act_click} />
                <span>Dashboard</span>
            </label>
            <label>
                <input type="radio" name="user" value="crud" onClick={act_click} />
                <span>Crud</span>
            </label>
            <h2>{ choice }</h2>
            <Suspense>
                { panel }
            </Suspense>
        </div> 
    )
}
