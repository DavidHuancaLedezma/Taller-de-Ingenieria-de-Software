import React, { useState } from "react";
import "./App.css"; // Importar el archivo CSS para estilos personalizados

const RegistroEstudiante = () => {
    const [nombre_usuario, setnombre_usuario] = useState("");
    const [apellido_estudiante, setapellido_estudiante] = useState("");
    const [telefono_usuario, settelefono_usuario] = useState("");
    const [correo_electronico_user, setcorreo_electronico_user] = useState("");
    const [contrasena, setContrasena] = useState("");
    const [contrasena_confirmation, setcontrasena_confirmation] = useState("");
    const [errores, setErrores] = useState({});

    const validarcorreo_electronico_user = (correo_electronico_user) => {
        const regex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/;
        return regex.test(correo_electronico_user);
    };

    const validarContrasena = (contrasena) => {
        const regex =
            /^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
        return regex.test(contrasena);
    };

    const validarTexto = (texto) => {
        const regex = /^[a-zA-Z\s]*$/;
        return regex.test(texto);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const nuevosErrores = {};

        // Validación de nombre_usuario y apellido_estudiante
        if (!validarTexto(nombre_usuario)) {
            nuevosErrores.nombre_usuario =
                "El nombre_usuario solo debe contener letras y espacios.";
        }
        if (!validarTexto(apellido_estudiante)) {
            nuevosErrores.apellido_estudiante =
                "El apellido_estudiante solo debe contener letras y espacios.";
        }

        // Validación de correo_electronico_user
        if (!validarcorreo_electronico_user(correo_electronico_user)) {
            nuevosErrores.correo_electronico_user =
                "El correo_electronico_user debe ser de Gmail o Hotmail y contener un @.";
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
                <h4 className="text-center mb-4">Registro Estudiante</h4>
                <form onSubmit={handleSubmit}>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="mb-3">
                                <label
                                    htmlFor="nombre_usuario_estudiante"
                                    className="form-label"
                                >
                                    nombre_usuario:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="nombre_usuario_estudiante"
                                    value={nombre_usuario}
                                    onChange={(e) => setnombre_usuario(e.target.value)}
                                    placeholder="nombre_usuario"
                                    required
                                />
                                {errores.nombre_usuario && (
                                    <p className="text-danger">
                                        {errores.nombre_usuario}
                                    </p>
                                )}
                            </div>

                            <div className="mb-3">
                                <label
                                    htmlFor="telefono_usuario"
                                    className="form-label"
                                >
                                    Teléfono:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="telefono_usuario"
                                    value={telefono_usuario}
                                    onChange={(e) =>
                                        settelefono_usuario(e.target.value)
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
                                    htmlFor="apellido_estudiante_estudiante"
                                    className="form-label"
                                >
                                    apellido_estudiantes:
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    id="apellido_estudiante_estudiante"
                                    value={apellido_estudiante}
                                    onChange={(e) =>
                                        setapellido_estudiante(e.target.value)
                                    }
                                    placeholder="apellido_estudiantes"
                                    required
                                />
                                {errores.apellido_estudiante && (
                                    <p className="text-danger">
                                        {errores.apellido_estudiante}
                                    </p>
                                )}
                            </div>

                            <div className="mb-3">
                                <label htmlFor="correo_electronico_user" className="form-label">
                                    correo_electronico_user Institucional:
                                </label>
                                <input
                                    type="email"
                                    className="form-control"
                                    id="correo_electronico_user"
                                    value={correo_electronico_user}
                                    onChange={(e) => setcorreo_electronico_user(e.target.value)}
                                    placeholder="correo_electronico_user Institucional"
                                    required
                                />
                                {errores.correo_electronico_user && (
                                    <p className="text-danger">
                                        {errores.correo_electronico_user}
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

export default RegistroEstudiante;