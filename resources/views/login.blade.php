<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
}

.login-container {
    background-color: #ffffff;
    padding: 4rem 3rem;
    width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.login-container h2 {
    margin-bottom: 1.5rem;
    font-size: 24px;
    color: #333;
}

.login-container input {
    width: 100%;
    padding: 0.8rem;
    margin: 0.5rem 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    background-color: #e9e9e9;
}

.login-container button {
    width: 100%;
    padding: 0.8rem;
    margin-top: 3rem;
    background-color: #367FA9;
    border: none;
    border-radius: 4px;
    color: #ffffff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-container button:hover {
    background-color: #118cd9;
}

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesion</h2>
        <form  method="POST">
            <input type="email" name="email" placeholder="Correo electronico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesion</button>
        </form>
    </div>
</body>
</html>
