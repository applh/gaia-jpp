import { useEffect, useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

import "primereact/resources/primereact.min.css";
import "primereact/resources/themes/lara-light-indigo/theme.css";

import { Button } from 'primereact/button';
import { Tree } from 'primereact/tree';
import { TreeNode } from 'primereact/treenode';

function App() {
  const [count, setCount] = useState(0)
  const [nodes, setNodes] = useState<TreeNode[]>([]);

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

  function treeDrop(e) {
    setNodes(e.value)
    // warning 
    // nodes is not updated
    // e.value is updated
    console.log(e.value, nodes)
  }

  return (
    <>
      <div>
        <a href="https://vitejs.dev" target="_blank">
          <img src={viteLogo} className="logo" alt="Vite logo" />
        </a>
        <a href="https://react.dev" target="_blank">
          <img src={reactLogo} className="logo react" alt="React logo" />
        </a>
      </div>
      <h1>Vite + React</h1>
      <Button label="Check" icon="pi pi-check" />
      <Tree value={nodes} dragdropScope="demo" onDragDrop={treeDrop} className="w-full md:w-30rem" />
    </>
  )
}

export default App
