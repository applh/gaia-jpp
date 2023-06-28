// redux store
import { useEffect } from 'react'
import { useSelector, useDispatch } from 'react-redux'
// import { useAppDispatch } from '../../app/store'
import { postSelect, setItems } from './postSlice'

// isolate config
import myConfig from '../my-config/config'

// CSS
import './PostList.css'

export default function PostList ()
{
    // react redux
    // WARNING:  
    // hooks can only be called inside of the body of a function component.
    // useDispatch is a hook 
    const dispatch = useDispatch()
    // https://redux-toolkit.js.org/usage/usage-with-typescript
    // const dispatch = useAppDispatch()

    const post = useSelector(postSelect)
    
    // https://react.dev/reference/react/useEffect#troubleshooting
    useEffect(() => {
        console.log('useEffect')
        // hack: async function in useEffect
        // https://react.dev/learn/synchronizing-with-effects#fetching-data
        async function fetchData () {
            console.log('fetchData', myConfig.api.url)
            const response = await fetch(myConfig.api.url)
            const json = await response.json()
            dispatch(setItems(json))
        }
        fetchData()

        // more complicated alternative to async function by createAsyncThunk
        // hack on TS typing
        // dispatch(fetchItems() as any)

        return () => {
            console.log('useEffect/fetchData', 'cleanup')
        }
    
    }, [ ])

    const items = post.items.map((item: any) => {
        return (
            <li key={item.id}>
                <h3>{item.title} [ { item.z } | { item.id } | { item.created.substr(2, 8) } ]</h3>
                <p><a target="_blank" href={item.url}>{ item.url }</a></p>
                <div className="box-img">
                    <img src={ myConfig.api.img_prefix + item.id + '.png'} />
                </div>
            </li>
        )
    })
    return (
        <div>
            <h2>Post List (total: { post.items.length })</h2>
            <ol>
                { items }
            </ol>
        </div>
    )
}