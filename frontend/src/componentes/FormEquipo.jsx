import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import { useState } from "react";
import { DotSpinner } from '@uiball/loaders';

function FormEquipo() {
    const [nombre, setNombre] = useState("");
    const [observacion, setObservacion] = useState("");

    let handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await fetch("http://localhost:8000/api/equipo", {
                method: "POST",
                body: JSON.stringify({
                    nombre: nombre,
                    observacion: observacion,
                }),
            })
            .then(res => res.json())
            .then((res) => {
                if (res.status === 201) {
                    setNombre("");
                    setObservacion("");
                } else {
                    alert("Error al crear el equipo");
                }
            });
        } catch (err) {
            console.log(err);
        }
    };
    return (
        <Form onSubmit={handleSubmit}>
            <Form.Group className="mb-3" controlId="formBasicNombre">
                <Form.Label>Nombre Equipo</Form.Label>
                <Form.Control type="text" placeholder="Nombre Equipo" value={nombre}
                    onChange={(e) => setNombre(e.target.value)}/>
            </Form.Group>

            <Form.Group className="mb-3" controlId="formBasicObservacion">
                <Form.Label>observacion Equipo</Form.Label>
                <Form.Control type="text" placeholder="Observacion Equipo" value={observacion}
                    onChange={(e) => setObservacion(e.target.value)}/>
            </Form.Group>

            <Button variant="primary" type="submit">
                Agregar
            </Button>
        </Form>
    );
}

export default FormEquipo;