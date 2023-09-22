
import Table from 'react-bootstrap/Table';

function Tabla({datos}) {
    return (
      <>
      <h1>Tabla de posiciones</h1>
      <Table striped bordered hover variant="dark">
        <thead>
          <tr>
            <th>Posición</th>
            <th>Equipo</th>
            <th>Puntos</th>
            <th>Partidos Jugados</th>
            <th>Partidos Ganados</th>
            <th>Partidos Perdidos</th>
            <th>Set Ganados</th>
            <th>Set Perdidos</th>
            <th>Copeficiente Set</th>
            <th>Puntos a favor</th>
            <th>Puntos en contra</th>
            <th>Coeficiente Puntos</th>
          </tr>
        </thead>
        <tbody>
            { datos.map((value, index) =>{
                return(
                    <tr key={index}>
                        <td>{index+1}</td>
                        <td>{value.equipo}</td>
                        <td>{value.puntos}</td>
                        <td>{value.partidosJugados}</td>
                        <td>{value.partidosGanados}</td>
                        <td>{value.partidosPerdidos}</td>
                        <td>{value.setGanados}</td>
                        <td>{value.setPerdidos}</td>
                        <td>{value.coeficienteSet}</td>
                        <td>{value.puntosAFavor}</td>
                        <td>{value.puntosEnContra}</td>
                        <td>{value.coeficientePuntos}</td>
                    </tr>
                )
            } )}
        </tbody>
      </Table>
      </>
    );
  }
  
  export default Tabla;