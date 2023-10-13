import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

function FormEquipo() {
    
    return (
        <Form>
            <Form.Group className="mb-3" controlId="formBasicNombre">
                <Form.Label>Nombre Equipo</Form.Label>
                <Form.Control type="text" placeholder="Nombre Equipo" />
            </Form.Group>

            <Button variant="primary" type="submit">
                Agregar
            </Button>
        </Form>
    );
}

export default FormEquipo;