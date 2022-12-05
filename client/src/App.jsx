import { Route, Routes } from 'react-router-dom';
import Home from '../Home';
import './App.css';
import Dashboard from './Dashboard';
import Google from './Google';

function App() {
  return (
    <div className='App'>
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/google/callback' element={<Google />} />
        <Route path='/dashboard' element={<Dashboard />} />
      </Routes>
    </div>
  );
}

export default App;
