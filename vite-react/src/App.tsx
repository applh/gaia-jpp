import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

// warning: vite errors if imported separately ?!
import { Button, CssBaseline} from '@mui/material'
import TreeView from '@mui/lab/TreeView';
import TreeItem from '@mui/lab/TreeItem';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import ChevronRightIcon from '@mui/icons-material/ChevronRight';

function CollIcon () {
  return <span>-</span>
}

function ExpIcon () {
  return <span>+</span>
}

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <CssBaseline />
      <div>
        <a href="https://vitejs.dev" target="_blank">
          <img src={viteLogo} className="logo" alt="Vite logo" />
        </a>
        <a href="https://react.dev" target="_blank">
          <img src={reactLogo} className="logo react" alt="React logo" />
        </a>
      </div>
      <h1>Vite + React</h1>
      <Button color="primary">hello</Button>
      <TreeView
  aria-label="file system navigator"
  defaultCollapseIcon={<CollIcon />}
  defaultExpandIcon={<ExpIcon />}
  sx={{ height: 240, flexGrow: 1, maxWidth: 400, overflowY: 'auto' }}
>
  <TreeItem nodeId="1" label="Applications">
    <TreeItem nodeId="2" label="Calendar" />
  </TreeItem>
  <TreeItem nodeId="5" label="Documents">
    <TreeItem nodeId="10" label="OSS" />
    <TreeItem nodeId="6" label="MUI">
      <TreeItem nodeId="8" label="index.js" />
    </TreeItem>
  </TreeItem>
</TreeView>
      <div className="card">
        <button onClick={() => setCount((count) => count + 1)}>
          count is {count}
        </button>
        <p>
          Edit <code>src/App.tsx</code> and save to test HMR
        </p>
      </div>
      <p className="read-the-docs">
        Click on the Vite and React logos to learn more
      </p>
    </>
  )
}

export default App
