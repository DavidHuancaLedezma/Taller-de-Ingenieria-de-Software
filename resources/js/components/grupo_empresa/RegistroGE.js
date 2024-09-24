import React, { useState } from 'react';
import { createRoot } from 'react-dom/client'; // Importa createRoot

function RegistroGE() {
    // Definimos el estado de los inputs y los errores
    const [formData, setFormData] = useState({
        nombre_largo: '',   
        nombre_corto: '',     
        direccion: '',     
        telefono: '',       
        correo: ''
    });
    

    const [errors, setErrors] = useState({});

    // Función para manejar cambios en los inputs
    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    // Función para validar el formulario antes de enviarlo
    const validateForm = () => {
        const { nombreLargo, nombreCorto, representante, direccion, telefono, correo } = formData;
        const newErrors = {};

        if (!nombreLargo.trim()) newErrors.nombreLargo = "El nombre largo es obligatorio.";
        if (!nombreCorto.trim()) newErrors.nombreCorto = "El nombre corto es obligatorio.";
        if (!representante.trim()) newErrors.representante = "El representante legal es obligatorio.";
        if (!direccion.trim()) newErrors.direccion = "La dirección es obligatoria.";
        if (!telefono.trim()) newErrors.telefono = "El teléfono es obligatorio.";
        if (!correo.trim()) newErrors.correo = "El correo es obligatorio.";
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) newErrors.correo = "El correo no es válido.";
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    // Función para manejar el envío del formulario
    const handleSubmit = (e) => {
        e.preventDefault();

        if (validateForm()) {
            fetch('/registro-grupo-empresa', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                // Manejar la respuesta del servidor aquí
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    };

    return (
        <div className="container mt-5">
            <h2>Registro de Grupo Empresa</h2>
            <form method="POST" onSubmit={handleSubmit} noValidate>
                <div className="form-group mb-3">
                <input
                        type="text"
                        name="nombreLargo"
                        placeholder="Nombre Largo"
                        value={formData.nombreLargo}
                        onChange={handleChange}
                        className={`form-control ${errors.nombreLargo ? 'is-invalid' : ''}`}
                        required
                    />
                    {errors.nombreLargo && <div className="invalid-feedback">{errors.nombreLargo}</div>}
                </div>

                <div className="form-group mb-3">
                    <input
                        type="text"
                        name="nombreCorto"
                        placeholder="Nombre Corto"
                        value={formData.nombreCorto}
                        onChange={handleChange}
                        className={`form-control ${errors.nombreCorto ? 'is-invalid' : ''}`}
                        required
                    />
                    {errors.nombreCorto && <div className="invalid-feedback">{errors.nombreCorto}</div>}
                </div>

                <div className="form-group mb-3">
                    <input
                        type="tel"
                        name="telefono"
                        placeholder="Teléfono"
                        value={formData.telefono}
                        onChange={handleChange}
                        className={`form-control ${errors.telefono ? 'is-invalid' : ''}`}
                        required
                    />
                    {errors.telefono && <div className="invalid-feedback">{errors.telefono}</div>}
                </div>

                <div className="form-group mb-3">
                    <input
                        type="text"
                        name="direccion"
                        placeholder="Dirección"
                        value={formData.direccion}
                        onChange={handleChange}
                        className={`form-control ${errors.direccion ? 'is-invalid' : ''}`}
                        required
                    />
                    {errors.direccion && <div className="invalid-feedback">{errors.direccion}</div>}
                </div>

                <div className="form-group mb-3">
                    <input
                        type="email"
                        name="correo"
                        placeholder="Correo Electrónico"
                        value={formData.correo}
                        onChange={handleChange}
                        className={`form-control ${errors.correo ? 'is-invalid' : ''}`}
                        required
                    />
                    {errors.correo && <div className="invalid-feedback">{errors.correo}</div>}
                </div>

                <div className="mb-3">
                    <div className="form-check">
                        <input type="checkbox" id="avisoLegal" className="form-check-input" required />
                        <label className="form-check-label" htmlFor="avisoLegal">
                            He leído y acepto el <a href="#" target="_blank">aviso legal y la Política de privacidad</a>
                        </label>
                    </div>
                </div>

                <div className="mb-3">
                    <div className="form-check">
                        <input type="checkbox" id="terminos" className="form-check-input" required />
                        <label className="form-check-label" htmlFor="terminos">
                            Acepto los <a href="#" target="_blank">términos y condiciones</a>
                        </label>
                    </div>
                </div>

                <button type="submit" className="btn btn-primary">Registrarse</button>
            </form>
        </div>
    );
}

export default RegistroGE;

// Montar el componente usando createRoot en lugar de render
const rootElement = document.getElementById('RegistroGE');
if (rootElement) {
    const root = createRoot(rootElement); // Aquí usamos createRoot
    root.render(<RegistroGE/>); // Renderiza el componente usando createRoot
}

