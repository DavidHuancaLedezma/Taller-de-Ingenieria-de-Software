import React, { useState } from "react";
import "./App.css"; // Importar el archivo CSS para estilos personalizados

const RegistroDocente = () => {
    const [nombre_docente, setnombre_docente] = useState("");
    const [apellido_docente, setapellido_docente] = useState("");
    const [telefono_docente, settelefono_docente] = useState("");
    const [correo_docente, setcorreo_docente] = useState("");
    const [contrasena, setContrasena] = useState("");
    const [contrasena_confirmation, setcontrasena_confirmation] = useState("");
    const [errores, setErrores] = useState({});

    const validarcorreo_docente = (correo_docente) => {
        const regex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/;
        return regex.test(correo_docente);
    };

    const validarContrasena = (contrasena) => {
        const regex =
            /^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%#?&]{6,}$/;
        return regex.test(contrasena);
    };

    const validarTexto = (texto) => {
        const regex = /^[a-zA-Z\s]*$/;
        return regex.test(texto);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const nuevosErrores = {};

        // Validación de nombre_docente y apellido_docente
        if (!validarTexto(nombre_docente)) {
            nuevosErrores.nombre_docente =
                "El nombre solo debe contener letras y espacios.";
        }
        if (!validarTexto(apellido_docente)) {
            nuevosErrores.apellido_docente =
                "El apellido solo debe contener letras y espacios.";
        }

        // Validación de correo_docente
        if (!validarcorreo_docente(correo_docente)) {
            nuevosErrores.correo_docente =
                "El correo debe ser de Gmail o Hotmail y contener un @.";
        }

        // Validación de contraseña
        if (!validarContrasena(contrasena)) {
            nuevosErrores.contrasena =
                "La contraseña debe tener al menos 6 caracteres, incluir letras, números y un símbolo.";
        }

        // Validación de confirmación de contraseña
        if (contrasena !== contrasena_confirmation) {
            nuevosErrores.contrasena_confirmation = "Las contraseñas no coinciden.";
        }

        setErrores(nuevosErrores);

        if (Object.keys(nuevosErrores).length === 0) {
            alert("Formulario enviado con éxito!");
            // Lógica para enviar el formulario al servidor aquí
        }
    };

    return (
        <div className="container d-flex justify-content-center mt-5">
            <div className="custom-container">
                <h4 className="text-center mb-4">Registro Docente</h4>
                <form onSubmit={handleSubmit}>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="mb-3">
                                <label
                                    htmlFor="nombre_docente"
                                    className="form-label"
                                >
                                    Nombre:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="nombre_docente"
                                    value={nombre_docente}
                                    onChange={(e) => setnombre_docente(e.target.value)}
                                    placeholder="Nombre"
                                    required
                                />
                                {errores.nombre_docente && (
                                    <p className="text-danger">
                                        {errores.nombre_docente}
                                    </p>
                                )}
                            </div>

                            <div className="mb-3">
                                <label
                                    htmlFor="telefono_docente"
                                    className="form-label"
                                >
                                    Teléfono:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="telefono_docente"
                                    value={telefono_docente}
                                    onChange={(e) =>
                                        settelefono_docente(e.target.value)
                                    }
                                    placeholder="Teléfono"
                                />
                            </div>

                            <div className="mb-3">
                                <label
                                    htmlFor="contrasena"
                                    className="form-label"
                                >
                                    Contraseña:
                                </label>
                                <input
                                    type="password"
                                    className="form-control"
                                    id="contrasena"
                                    value={contrasena}
                                    onChange={(e) =>
                                        setContrasena(e.target.value)
                                    }
                                    placeholder="Contraseña"
                                    required
                                />
                                {errores.contrasena && (
                                    <p className="text-danger">
                                        {errores.contrasena}
                                    </p>
                                )}
                            </div>
                        </div>

                        <div className="col-md-6">
                            <div className="mb-3">
                                <label
                                    htmlFor="apellido_docente"
                                    className="form-label"
                                >
                                    Apellido:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="apellido_docente"
                                    value={apellido_docente}
                                    onChange={(e) =>
                                        setapellido_docente(e.target.value)
                                    }
                                    placeholder="Apellido"
                                    required
                                />
                                {errores.apellido_docente && (
                                    <p className="text-danger">
                                        {errores.apellido_docente}
                                    </p>
                                )}
                            </div>

                            <div className="mb-3">
                                <label htmlFor="correo_docente" className="form-label">
                                    Correo Institucional:
                                </label>
                                <input
                                    type="email"
                                    className="form-control"
                                    id="correo_docente"
                                    value={correo_docente}
                                    onChange={(e) => setcorreo_docente(e.target.value)}
                                    placeholder="Correo Institucional"
                                    required
                                />
                                {errores.correo_docente && (
                                    <p className="text-danger">
                                        {errores.correo_docente}
                                    </p>
                                )}
                            </div>

                            <div className="mb-3">
                                <label
                                    htmlFor="confirmar_contrasena"
                                    className="form-label"
                                >
                                    Confirmar Contraseña:
                                </label>
                                <input
                                    type="password"
                                    className="form-control"
                                    id="confirmar_contrasena"
                                    value={contrasena_confirmation}
                                    onChange={(e) =>
                                        setcontrasena_confirmation(e.target.value)
                                    }
                                    placeholder="Confirmar Contraseña"
                                    required
                                />
                                {errores.contrasena_confirmation && (
                                    <p className="text-danger">
                                        {errores.contrasena_confirmation}
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>

                    <div className="form-check mb-3">
                        <input
                            className="form-check-input"
                            type="checkbox"
                            id="privacy_policy"
                            required
                        />
                        <label
                            className="form-check-label"
                            htmlFor="privacy_policy"
                        >
                            He leído y acepto el aviso legal y la Política de
                            privacidad. *
                        </label>
                    </div>
                    <div className="form-check mb-4">
                        <input
                            className="form-check-input"
                            type="checkbox"
                            id="terms_conditions"
                            required
                        />
                        <label
                            className="form-check-label"
                            htmlFor="terms_conditions"
                        >
                            Acepto los términos y condiciones. *
                        </label>
                    </div>

                    <div className="d-flex justify-content-center">
                        <button type="submit" className="btn btn-custom">
                            REGISTRARSE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default RegistroDocente;