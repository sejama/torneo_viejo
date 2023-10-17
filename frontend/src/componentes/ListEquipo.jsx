import ListGroup from 'react-bootstrap/ListGroup';
import { useState, useEffect } from 'react';
import { DotSpinner } from '@uiball/loaders';
function ListEquipo() {
    const [isLoading, setIsLoading] = useState(true);
    const [equipos, setEquipos] = useState([]);

    useEffect(() => {
        fetch(`http://localhost:8000/api/equipo`)
        .then(res => res.json())
        .then((res) => {
        setEquipos(res);
        setIsLoading(false);
        });
    }, []);
    if (isLoading) {
    return (
        <div style={{position: 'absolute', left: '50%', top: '50%', transform: 'translate(-50%, -50%)'}}>
        <DotSpinner size={100} speed={0.5} color="black" />
        </div>
    );
    }
    const options = equipos.map((item) => {
        return (
            <ListGroup.Item>{item.nombre} </ListGroup.Item>
        )
      })
    return (
        <ListGroup>
            {options}
        </ListGroup>
    );
}

export default ListEquipo;