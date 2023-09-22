import Form from 'react-bootstrap/Form';

const opciones = [
    { value: '1', label: 'Femenino +30' },
    { value: '2', label: 'Femenino +35' },
    { value: '3', label: 'Femenino +40' },
    { value: '4', label: 'Femenino +45' },
    { value: '5', label: 'Masculino +35' },
    { value: '6', label: 'Masculino +40' },
    { value: '7', label: 'Masculino +45' },
]

function Selector() {
  return (
    <Form.Select aria-label="Default select example" >
      <option>Seleccionar</option>
        {opciones.map((item) => (
            <option key={item.value} value={item.value}>{item.label}</option>
        ))}
    </Form.Select>
  );
}

export default Selector;