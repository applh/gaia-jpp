// redux store
import { useEffect } from 'react'
import { useSelector, useDispatch } from 'react-redux'
import { setItems, IPostState } from './postSlice'

// isolate config
import myConfig from '../my-config/config'

export default function PostList ()
{

    // react redux
    const dispatch = useDispatch()
    const post = useSelector((state: IPostState) => {
        console.log('post', state)
        return state.post.value
    })
    
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
            return () => {
                console.log('fetchData', 'cleanup')
            }
        }

        fetchData()
    }, [ ])

    const items = post.items.map((item: any) => {
        return (
            <li key={item.id}>
                <h3>{item.title} / { item.id } / { item.created.substr(2, 8) }</h3>
                <p><a target="_blank" href={item.url}>{ item.url }</a></p>
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