import { lazy, useState, useEffect, Suspense } from 'react'
import { useSelector, useDispatch } from 'react-redux'

// WARNING: don't forget to add reducer to app/store.tsx
import { increment, ICounterState } from './features/counter/counterSlice'
import { ITreeState, setTreeData } from './features/tree/treeSlice'
import { IUserState, setUserMode } from './features/user/userSlice.tsx'

// import './App.css'

import { Counter } from './features/counter/Counter.tsx'

const Member = lazy(() => import('./features/user/Member.tsx'))
const Admin = lazy(() => import('./features/user/Admin.tsx'))
import Login from './features/user/Login.tsx'

import "primereact/resources/primereact.min.css";
import "primereact/resources/themes/lara-light-indigo/theme.css";
import 'primeicons/primeicons.css';

import { Button } from 'primereact/button';
import { Tree } from 'primereact/tree';
import { TreeNode } from 'primereact/treenode';

function App() {
  const [nodes, setNodes] = useState<TreeNode[]>([]);


  const dispatch = useDispatch()
  const counter = useSelector((state: ICounterState) => state.counter.value)
  const treeData = useSelector((state: ITreeState) => state.tree.value)
  const user = useSelector((state: IUserState) => state.user.value)

  const data = [
    {
      key: '0',
      label: 'Documents',
      data: 'Documents Folder',
      icon: 'pi pi-fw pi-inbox',
      children: [
        {
          key: '0-0',
          label: 'Work',
          data: 'Work Folder',
          icon: 'pi pi-fw pi-cog',
          children: [
            { key: '0-0-0', label: 'Expenses.doc', icon: 'pi pi-fw pi-file', data: 'Expenses Document' },
            { key: '0-0-1', label: 'Resume.doc', icon: 'pi pi-fw pi-file', data: 'Resume Document' }
          ]
        },
        {
          key: '0-1',
          label: 'Home',
          data: 'Home Folder',
          icon: 'pi pi-fw pi-home',
          children: [{ key: '0-1-0', label: 'Invoices.txt', icon: 'pi pi-fw pi-file', data: 'Invoices for this month' }]
        }
      ]
    },
    {
      key: '1',
      label: 'Events',
      data: 'Events Folder',
      icon: 'pi pi-fw pi-calendar',
      children: [
        { key: '1-0', label: 'Meeting', icon: 'pi pi-fw pi-calendar-plus', data: 'Meeting' },
        { key: '1-1', label: 'Product Launch', icon: 'pi pi-fw pi-calendar-plus', data: 'Product Launch' },
        { key: '1-2', label: 'Report Review', icon: 'pi pi-fw pi-calendar-plus', data: 'Report Review' }
      ]
    },
    {
      key: '2',
      label: 'Movies',
      data: 'Movies Folder',
      icon: 'pi pi-fw pi-star-fill',
      children: [
        {
          key: '2-0',
          icon: 'pi pi-fw pi-star-fill',
          label: 'Al Pacino',
          data: 'Pacino Movies',
          children: [
            { key: '2-0-0', label: 'Scarface', icon: 'pi pi-fw pi-video', data: 'Scarface Movie' },
            { key: '2-0-1', label: 'Serpico', icon: 'pi pi-fw pi-video', data: 'Serpico Movie' }
          ]
        },
        {
          key: '2-1',
          label: 'Robert De Niro',
          icon: 'pi pi-fw pi-star-fill',
          data: 'De Niro Movies',
          children: [
            { key: '2-1-0', label: 'Goodfellas', icon: 'pi pi-fw pi-video', data: 'Goodfellas Movie' },
            { key: '2-1-1', label: 'Untouchables', icon: 'pi pi-fw pi-video', data: 'Untouchables Movie' }
          ]
        }
      ]
    }
  ];

  useEffect(() => {
    console.log('useEffect');
    setNodes(data);
  }, []);

  // react useState data
  function treeDrop(e: any) {
    setNodes(e.value)
    // warning 
    // nodes is not updated
    // e.value is updated
    console.log(e, e.value, nodes)
  }

  // redux treeData
  function treeDataDrop(e: any) {
    console.log(e, e.value, nodes)
    // request update of treeData
    dispatch(setTreeData(e.value))
  }

  const act_change = function (event: React.ChangeEvent<HTMLElement>) {
    const user_choice = event.currentTarget.getAttribute('value') as string
    console.log('act_change', user_choice, event)
    // reactivity
    dispatch(setUserMode(user_choice))
  }

  let userPanel = <Login />
  if (user.userMode === 'member') {
    userPanel = <Member />
  }
  if (user.userMode === 'admin') {
    userPanel = <Admin />
  }

  return (
    <>
      <label>
        <input type="radio" name="userMode" value="login" checked={user.userMode == 'login'} onChange={act_change} />
        <span>Login</span>
      </label>
      <label>
        <input type="radio" name="userMode" value="admin" onChange={act_change} />
        <span>Admin</span>
      </label>
      <label>
        <input type="radio" name="userMode" value="member" onChange={act_change} />
        <span>Member</span>
      </label>
      <p>user: { user.name }</p>
      <Suspense>
        {userPanel}
      </Suspense>
      <p>Vite + React + Redux + PrimeReact</p>
      <Button label={'Click ' + counter} icon="pi pi-check" onClick={() => dispatch(increment())} />
      <Counter />
      <Tree value={nodes} dragdropScope="demo" onDragDrop={treeDrop} className="w-full md:w-30rem" />
      <Tree value={treeData} dragdropScope="demo" onDragDrop={treeDataDrop} className="w-full md:w-30rem" />
    </>
  )
}

export default App
