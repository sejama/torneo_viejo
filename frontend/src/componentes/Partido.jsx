import Table from 'react-bootstrap/Table';

function Partido() {
    const partido = {
        "partido": 1,
        "local": "Equipo 1",
        "visitante": "Equipo 2",
        "set1Local": 25,
        "set1Visitante": 15,
        "set2Local": 10,
        "set2Visitante": 25,
        "set3Local": 10,
        "set3Visitante": 15,
        "set4Local": null,
        "set4Visitante": null,
        "set5Local": null,
        "set5Visitante": null,}
    return (
      <>
      <h1>Partido {partido.partido}</h1>
      <Table striped bordered hover variant="dark">
        <thead>
          <tr>
            <th>Equipo</th>
            <th>Set 1</th>
            <th>Set 2</th>
            <th>Set 3</th>
            <th>Set 4</th>
            <th>Set 5</th>
            <th>Total Puntos</th>
            <th>Total Set</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>{partido.local}</td>
                <td>{partido.set1Local}</td>
                <td>{partido.set2Local}</td>
                <td>{partido.set3Local}</td>
                <td>{partido.set4Local? partido.set4Local : '-'}</td>
                <td>{partido.set5Local? partido.set5Local : '-'}</td>
                <td>{partido.set1Local+partido.set2Local+partido.set3Local+partido.set4Local+partido.set5Local}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>{partido.visitante}</td>
                <td>{partido.set1Visitante}</td>
                <td>{partido.set2Visitante}</td>
                <td>{partido.set3Visitante}</td>
                <td>{partido.set4Visitante? partido.set4Visitante : '-'}</td>
                <td>{partido.set5Visitante? partido.set5Visitante : '-'}</td>
                <td>{partido.set1Visitante+partido.set2Visitante+partido.set3Visitante+partido.set4Visitante+partido.set5Visitante}</td>
                <td>2</td>
            </tr>
        </tbody>
      </Table>
      </>
    );
  }
  
  export default Partido;