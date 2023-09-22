import { useState, useEffect } from 'react';
import { DotSpinner } from '@uiball/loaders';


 
 function Api() {
    const [isLoading, setIsLoading] = useState(true);
    const [titulo, setTitulo] = useState(null);

    useEffect(() => {
        fetch(`http://localhost:8000/api/torneo/1`)
        .then(res => res.json())
        .then((res) => {
        setTitulo(res.nombre);
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
    return (
        <h1>{titulo}</h1>
    )
}

export default Api;