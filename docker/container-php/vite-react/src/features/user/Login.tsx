import { useDispatch, useSelector } from "react-redux"
import { userSelect, setLoginEmail, setLoginPassword, setUserInfos } from "./userSlice"

import config from "../my-config/config"

export default function Login () {

    const dispatch = useDispatch()
    const user = useSelector(userSelect)

    const act_login = async function (event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault()
        console.log('act_login', user, event.target)

        // add CORS header in request
        // and ignore SSL error
        const url = config.api.url_login

        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            },
            body: JSON.stringify(user.form_login)
        }
        const response = await fetch(url, options)
        const data = await response.json()
        // hack role
        data.role = 'admin'
        console.log('data', data)
        dispatch(setUserInfos(data))
    }

    return (
        <div>
            <h1>Login</h1>
            <form onSubmit={act_login}>
                <input type="email" name="email" placeholder="your email" value={user.form_login.email} onChange={ e => dispatch(setLoginEmail(e.target.value))}/>
                <input type="password" name="password" placeholder="your password" value={user.form_login.password} onChange={ e => dispatch(setLoginPassword(e.target.value))}/>
                <button>Login Now</button>
            </form>
            <hr />
            <p>email: {user.form_login.email }</p>
            <p>password: {user.form_login.password }</p>
            <p>role: {user.role }</p>
            <hr />
        </div>
    )
}