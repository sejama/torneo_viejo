import React, { useState } from 'react';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';

function FormInscrpcion() {  
    const [validated, setValidated] = useState(false);

    const  handleSubmit = (event) => {
        const form = event.currentTarget;
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        const nombre = form.inputNombre.value;
        const descripcion = form.inputDescripcion.value;
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nombre: nombre, descripcion: descripcion })
        };
        fetch('http://127.0.0.1:8000/api/equipo', requestOptions)
            .then(response => response.json())
            .then(data => alert("ID: " + data.id))
            .catch(error => 
                alert("Error: " + error))
        
        setValidated(true);
    };
    
    return (
    <>
        <Container>
            <h2>Agregar Equipo</h2>
                <Form noValidate validated={validated} onSubmit={handleSubmit}>
                    <Form.Group as={Row} className="mb-3" controlId="formBasicEquipo">
                        <Form.Label column sm="3">Nombre Equipo</Form.Label>
                        <Col sm="9">
                            <Form.Control required type="text" name="inputNombre" placeholder="Equipo" />
                            <Form.Control.Feedback type="invalid">Por favor ingrese el nombre del equipo!</Form.Control.Feedback>
                        </Col>
                    </Form.Group>
                    <Form.Group as={Row} className="mb-3" controlId="formBasicDescripcion">
                        <Form.Label column sm="3">Observación</Form.Label>
                        <Col sm="9">
                            <Form.Control type="text" name="inputDescripcion" placeholder="Descripción" />
                        </Col>
                    </Form.Group>
                    <Button variant="primary" type="submit">
                        Inscribir
                    </Button>
                </Form>
            
        </Container>

    </>
    );
}

export default FormInscrpcion;