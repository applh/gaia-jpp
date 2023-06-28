// redux store
import { useDispatch, useSelector } from 'react-redux'
import { logout, userSelect } from './userSlice'

export default function Member() {
    // react redux
    const dispatch = useDispatch()
    const act_logout = function (event: React.MouseEvent<HTMLElement>) {
        console.log('act_logout', event)
        dispatch(logout())
    }

    const user = useSelector(userSelect)

    return (
        <div>
            <h1>Member ({ user.name })</h1>
            <label>
                <button onClick={act_logout}>Logout</button>
            </label>
        </div>
    )
}