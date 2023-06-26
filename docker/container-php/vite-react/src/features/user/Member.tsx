// redux store
import { useDispatch, useSelector } from 'react-redux'
import { IUserState, logout } from './userSlice'

export default function Member() {
    // react redux
    const dispatch = useDispatch()
    const act_logout = function (event: React.MouseEvent<HTMLElement>) {
        console.log('act_logout', event)
        dispatch(logout())
    }

    const user = useSelector((state: IUserState) => {
        console.log('user', state)
        return state.user.value
    })

    return (
        <div>
            <h1>Member ({ user.name })</h1>
            <label>
                <button onClick={act_logout}>Logout</button>
            </label>
        </div>
    )
}