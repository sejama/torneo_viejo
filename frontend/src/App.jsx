import './App.css';
import  'bootstrap/dist/css/bootstrap.min.css' ;
import NavBar from './componentes/NavBar';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Tabla from './componentes/Tabla';
import Partido from './componentes/Partido';
import zona from './componentes/datos'
import Selector from './componentes/Select';

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <NavBar />
        <Routes>
          <Route path="/" element={<h1>Inicio</h1>} />
          <Route path="/tablas" element={<Tabla datos={zona} />} />
          <Route path="/partidos" element={<Partido />} />
          <Route path="/selector" element={<Selector/>} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
