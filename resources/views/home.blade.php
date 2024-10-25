<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sidebar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        :root{
            --color-barra-lateral:#222D32;

            --color-texto:rgb(255, 255, 255);
            --color-texto-menu:rgb(134,136,144);

            --color-menu-hover:rgb(238,238,238);
            --color-menu-hover-texto:rgb(0,0,0);

            --color-boton:rgb(0,0,0);
            --color-boton-texto:rgb(255,255,255);

            --color-linea:rgb(180,180,180);

            --color-switch-base :rgb(201,202,206);
            --color-switch-circulo:rgb(241,241,241);

            --color-scroll:rgb(192,192,192);
            --color-scroll-hover:rgb(134,134,134);
        }
        .dark-mode{
            --color-barra-lateral:rgb(44,45,49);

            --color-texto:rgb(255,255,255);
            --color-texto-menu:rgb(110,110,117);

            --color-menu-hover:rgb(0,0,0);
            --color-menu-hover-texto:rgb(238,238,238);

            --color-boton:rgb(255,255,255);
            --color-boton-texto:rgb(0,0,0);

            --color-linea:rgb(90,90,90);

            --color-switch-base :rgb(39,205,64);
            --color-switch-circulo:rgb(255,255,255);

            --color-scroll:rgb(68,69,74);
            --color-scroll-hover:rgb(85,85,85);
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }
        body{
            height: 100vh;
            width: 100%;
            background-color: #D2D6DE;
        }

        /*-----------------Menu*/
        .menu{
            position: fixed;
            width: 50px;
            height: 50px;
            font-size: 30px;
            display: none;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            background-color: var(--color-boton);
            color: var(--color-boton-texto);
            right: 15px;
            top: 15px;
            z-index: 100;
        }


        /*----------------Barra Lateral*/
        .barra-lateral{
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 250px;
            height: 100%;
            overflow: hidden;
            padding: 20px 15px;
            background-color: var(--color-barra-lateral);
            transition: width 0.5s ease,background-color 0.3s ease,left 0.5s ease;
            z-index: 50;
        }

        .mini-barra-lateral{
            width: 80px;
        }
        .barra-lateral span{
            width: 100px;
            white-space: nowrap;
            font-size: 18px;
            text-align: left;
            opacity: 1;
            transition: opacity 0.5s ease,width 0.5s ease;
        }
        .barra-lateral span.oculto{
            opacity: 0;
            width: 0;
        }

        /*------------> Nombre de la página */
        .barra-lateral .nombre-pagina{
            width: 100%;
            height: 45px;
            color: var(--color-texto);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
        }
        .barra-lateral .nombre-pagina ion-icon{
            min-width: 50px;
            font-size: 40px;
            cursor: pointer;
        }
        .barra-lateral .nombre-pagina span{
            margin-left: 5px;
            font-size: 25px;
        }


        /*------------> Botón*/
        .barra-lateral .boton{
            width: 100%;
            height: 45px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 10px;
            background-color: var(--color-boton);
            color: var(--color-boton-texto);
        }
        .barra-lateral .boton ion-icon{
            min-width: 50px;
            font-size: 25px;
        }


        /*--------------> Menu Navegación*/
        .barra-lateral .navegacion{
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .barra-lateral .navegacion::-webkit-scrollbar{
            width: 5px;
        }
        .barra-lateral .navegacion::-webkit-scrollbar-thumb{
            background-color: var(--color-scroll);
            border-radius: 5px;
        }
        .barra-lateral .navegacion::-webkit-scrollbar-thumb:hover{
            background-color: var(--color-scroll-hover);
        }
        .barra-lateral .navegacion li{  
            list-style: none;
            display: flex;
            margin-bottom: 5px;
        }
        .barra-lateral .navegacion a{
            width: 100%;
            height: 45px;
            display: flex;
            align-items: center;
            text-decoration: none;
            border-radius: 10px;
            color: var(--color-texto-menu);
        }
        .barra-lateral .navegacion a:hover{
            /*background-color: var(--color-menu-hover);*/
            color: var(--color-menu-hover-texto);
        }
        .barra-lateral .navegacion ion-icon{
            min-width: 50px;
            font-size: 20px;
        }

        /*-----------------> Linea*/
        .barra-lateral .linea{
            width: 100%;
            height: 1px;
            margin-top: 15px;
            background-color: var(--color-linea);
        }

        /*----------------> Modo Oscuro*/
        .barra-lateral .modo-oscuro{
            width: 100%;
            margin-bottom: 80px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        }
        .barra-lateral .modo-oscuro .info{
            width: 150px;
            height: 45px;
            overflow: hidden;
            display: flex;
            align-items: center;
            color: var(--color-texto-menu);
        }
        .barra-lateral .modo-oscuro ion-icon{

            width: 50px;
            font-size: 20px;
        }

        /*--->switch*/
        .barra-lateral .modo-oscuro .switch{
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            height: 45px;
            cursor: pointer;
        }
        .barra-lateral .modo-oscuro .base{
            position: relative;
            display: flex;
            align-items: center;
            width: 35px;
            height: 20px;
            background-color: var(--color-switch-base);
            border-radius: 50px;
        }
        .barra-lateral .modo-oscuro .circulo{
            position: absolute;
            width: 18px;
            height: 90%;
            background-color: var(--color-switch-circulo);
            border-radius: 50%;
            left: 2px;
            transition: left 0.5s ease;
        }
        .barra-lateral .modo-oscuro .circulo.prendido{
            left: 15px;
        }

        /*---------------> Usuario*/
        .barra-lateral .usuario{
            width: 100%;
            display: flex;
        }
        .barra-lateral .usuario img{
            width: 50px;
            min-width: 50px;
            border-radius: 10px;
        }
        .barra-lateral .usuario .info-usuario{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--color-texto);
            overflow: hidden;
        }
        .barra-lateral .usuario .nombre-email{
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-left: 5px;
        }
        .barra-lateral .usuario .nombre{
            font-size: 15px;
            font-weight: 600;
        }
        .barra-lateral .usuario .email{
            font-size: 13px;
        }
        .barra-lateral .usuario ion-icon{
            font-size: 20px;
        }


        /*-------------main*/

        /*#inbox{

        }
        */
        .navegacion a.activo {
            background-color: var(--color-menu-hover);
            color: var(--color-menu-hover-texto);
        }

        main{
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s ease;
        }
        main.min-main{
            margin-left: 80px;
        }



        /*------------------> Responsive*/
        @media (max-height: 660px){
            .barra-lateral .nombre-pagina{
                margin-bottom: 5px;
            }
            .barra-lateral .modo-oscuro{
                margin-bottom: 3px;
            }
        }
        @media (max-width: 600px){
            .barra-lateral{
                position: fixed;
                left: -250px;
            }
            .max-barra-lateral{
                left: 0;
            }
            .menu{
                display: flex;
            }
            .menu ion-icon:nth-child(2){
                display: none;
            }
            main{
                margin-left: 0;
            }
            main.min-main{
                margin-left: 0;
            }
            
        }

        .modo-oscuro {
            pointer-events: none;
        }

        .container_home {
            max-width: 960px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .container_home h2 {
            margin-bottom: 30px;
            font-size: 24px;
        }

        .container_home .evaluation-card {
            display: flex;
            gap: 20px;
            justify-content: space-around;
            align-items: flex-start;
        }

        .container_home .card {
            background-color: #f0f8ff;
            border-radius: 8px;
            padding: 20px;
            width: 30%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container_home h3 {
            font-size: 18px;
            color: #333;
        }

        .container_home .description {
            font-size: 14px;
            color: #666;
        }


        .switch_autoevaluacion {
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_autoevaluacion h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_autoevaluacion .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_autoevaluacion .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_autoevaluacion .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_autoevaluacion h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_autoevaluacion .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_autoevaluacion .evaluation-form {
            margin-top: 10px;
        }

        .switch_autoevaluacion #btn-autoevaluacion {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_autoevaluacion #btn-autoevaluacion:hover {
            background-color: #789bc0;
        }

        .switch_evaluacion_cruzada{
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_evaluacion_cruzada h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_evaluacion_cruzada .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_evaluacion_cruzada .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_evaluacion_cruzada .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_evaluacion_cruzada h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_evaluacion_cruzada .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_evaluacion_cruzada .evaluation-form {
            margin-top: 10px;
        }

        .switch_evaluacion_cruzada #btn-evaluacion-cruzada {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_evaluacion_cruzada #btn-evaluacion-cruzada:hover {
            background-color: #789bc0;
        }
        
        .switch_evaluacion_pares{
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_evaluacion_pares h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_evaluacion_pares .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_evaluacion_pares .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_evaluacion_pares .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_evaluacion_pares h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_evaluacion_pares .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_evaluacion_pares .evaluation-form {
            margin-top: 10px;
            display: flex;
            flex-direction: row ;
            justify-content: center ;
            align-content: center;
        }

        .switch_evaluacion_pares #btn-evaluacion-pares {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: inline-block; 
        }

        .switch_evaluacion_pares #btn-evaluacion-pares:hover {
            background-color: #789bc0;
        }

        .header-planificacion{
            display : flex ; 
            flex-direction: column ; 
            justify-content: center ; 
            align-items: center; 
        }

        .switch_planificacion{
            display: flex ; 
            
        }
        .switch_hitos {
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_hitos h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_hitos .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_hitos .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_hitos .card-image-planificacion {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            height : 300px ; 
        }

        .switch_hitos h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_hitos .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_hitos .evaluation-form {
            margin-top: 10px;
        }

        .switch_hitos #btn-switch-hitos {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_hitos #btn-switch-hitos:hover {
            background-color: #789bc0;
        }

        .switch_objetivos {
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_objetivos h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_objetivos .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_objetivos .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_objetivos .card-image-planificacion {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            height : 300px ; 
        }

        .switch_objetivos h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_objetivos .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_objetivos .evaluation-form {
            margin-top: 10px;
        }

        .switch_objetivos #btn-switch-objetivos {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_objetivos #btn-switch-objetivos:hover {
            background-color: #789bc0;
        }

        .switch_actividades {
            max-width: 500px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_actividades h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_actividades .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_actividades .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_actividades .card-image-planificacion {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            height : 300px ; 
        }

        .switch_actividades h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_actividades .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_actividades .evaluation-form {
            margin-top: 10px;
        }

        .switch_actividades #btn-switch-actividades {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_actividades #btn-switch-actividades:hover {
            background-color: #789bc0;
        }
    </style>
</head>
<body>
    <input id="id-estudiante-home" type="hidden" value="{{$idEstudinte}}">
    <input id="autoevaluacion-realizada" type="hidden" value="{{$autoevaluacion}}">
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <ion-icon id="cloud"name="menu-outline"></ion-icon>
                <span>EMPRESA TIS</span>
            </div>
            <button class="boton">
                <ion-icon name="reload-outline"></ion-icon>
                <span>ESTUDIANTE</span>
            </button>
        </div>

        <nav class="navegacion">
            <ul>
                <li>
                    <a id="inbox"  onclick="cargarContenido('planificacion')">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <span>Planificacion</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('autoevaluacion')">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Autoevaluacion</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('Evaluacion_pares')">
                        <ion-icon name="people-outline"></ion-icon>
                        <span>Evaluacion de pares</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('evaluacion_cruzada')">
                        <ion-icon name="documents-outline"></ion-icon>
                        <span>Evaluacion cruzada</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('registro_grupo_empresa')">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Registro<br>Grupo Empresa</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div>
            <div class="linea"></div>

            <div class="modo-oscuro">
                <div class="info">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span>EliteSoft</span>
                </div>
                <div class="switch" >
                    <div class="base">
                        <div class="circulo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="contenido">
        <div class="container_home">
            <h2>Evaluaciones</h2>
            <div class="evaluation-card">
                <div class="card">
                    <h3>Autoevaluación</h3>
                    <p class="description">
                        Evaluación que permite a los equipos de trabajo y a sus integrantes realizar una retroalimentación sobre su trabajo.
                    </p>
                </div>
                <div class="card">
                    <h3>Evaluación Cruzada</h3>
                    <p class="description">
                        Evaluación que permite a los equipos de trabajo evaluar el trabajo de otros equipos.
                    </p>
                </div>
                <div class="card">
                    <h3>Evaluación en Pares</h3>
                    <p class="description">
                        Permite a los integrantes de un equipo evaluar el desempeño de sus compañeros de equipo.
                    </p>
                </div>
            </div>
        </div>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>

        console.log(document.getElementById("id-estudiante-home").value);
        const cloud = document.getElementById("cloud");
        const barraLateral = document.querySelector(".barra-lateral");
        const spans = document.querySelectorAll("span");
        const palanca = document.querySelector(".switch");
        const circulo = document.querySelector(".circulo");
        const menu = document.querySelector(".menu");
        const main = document.querySelector("main");

        const enlacesBarra = document.querySelectorAll('.navegacion a');

        menu.addEventListener("click",()=>{
            barraLateral.classList.toggle("max-barra-lateral");
            if(barraLateral.classList.contains("max-barra-lateral")){
                menu.children[0].style.display = "none";
                menu.children[1].style.display = "block";
            }
            else{
                menu.children[0].style.display = "block";
                menu.children[1].style.display = "none";
            }
            if(window.innerWidth<=320){
                barraLateral.classList.add("mini-barra-lateral");
                main.classList.add("min-main");
                spans.forEach((span)=>{
                    span.classList.add("oculto");
                })
            }
        });

        palanca.addEventListener("click",()=>{
            let body = document.body;
            body.classList.toggle("dark-mode");
            body.classList.toggle("");
            circulo.classList.toggle("prendido");
        });

        cloud.addEventListener("click",()=>{
            barraLateral.classList.toggle("mini-barra-lateral");
            main.classList.toggle("min-main");
            spans.forEach((span)=>{
                span.classList.toggle("oculto");
            });
        });

        function cargarContenido(seccion) {
            let idEstudiante = document.getElementById("id-estudiante-home").value;
            const contenido = document.getElementById('contenido');
            let html = '';
            switch (seccion) {
                case 'planificacion':
                    html = `
            <header class="header-planificacion">
                <h2>REGISTRO DE PLANIFICACION DE PROYECTOS</h2>
            </header>       
            <div class="switch_planificacion">        
                <div class="switch_hitos">
                    <div class="evaluation-card">
                        <div class="card">
                            <h3>REGISTRO DE HITOS</h3>
                            <img src="https://img.freepik.com/vector-premium/progreso-proyecto-flujo-trabajo-trabajo-hombre-completa-tareas-paso-paso_159757-1418.jpg" alt="Autoevaluacion" class="card-image-planificacion">
                            <h3>Registro de hitos</h3>
                            <p class="description">Los hitos son puntos críticos o eventos significativos que marcan el progreso en el proyecto.<p>  
                            <form action="{{ url('/registro_hitos/2')}}" method="GET">
                                <button id="btn-switch-hitos" type="submit">REGISTRO HITOS(idProyecto)</button>
                            </form>
                        </div>
                    </div>
                </div> 

                <div class="switch_objetivos">
                    
                    <div class="evaluation-card">
                        <div class="card">
                            <h3>REGISTRO DE OBJETIVOS</h3>
                            <img src="https://img.freepik.com/vector-premium/concepto-progresion-proyecto-hacer-cosas-tareas-completadas-o-logros-comerciales_178888-1909.jpg" alt="Autoevaluacion" class="card-image-planificacion">
                            <h3>Registro de hitos</h3>
                            <p class="description">Se formularán objetivos claros que guíen las actividades del equipo, asegurando el cumplimiento de los requerimientos del proyecto.<p>  
                            <form action="{{ url('/registro_objetivo/2')}}" method="GET">
                                <button id="btn-switch-objetivos" type="submit">REGISTRO OBJETIVOS(idProyecto)</button>
                            </form>                            
                        </div>
                    </div>
                </div> 
                <div class="switch_actividades">
                    <div class="evaluation-card">
                        <div class="card">
                            <h3>REGISTRO DE ACTIVIDADES</h3>
                            <img src="https://img.freepik.com/vector-premium/tecnica-planificacion-agil-tablero-hombre-marca-metas-tareas-completadas-trabajando-equipo_547662-1332.jpg" alt="Autoevaluacion" class="card-image-planificacion">
                            <h3>Registro de hitos</h3>
                            <p class="description">El registro de actividades incluye la planificación, asignación y seguimiento de tareas específicas a los miembros del equipo.<p>  
                            <form action="{{ url('/actividad/5')}}" method="GET">
                                <button id="btn-switch-actividades" type="submit">ACTIVIDADES(idObjetivo)</button>
                            </form>                        
                        </div>
                    </div>
                </div> 
                    `;
                    break;
                case 'autoevaluacion':
                    let autoevaluacion = document.getElementById("autoevaluacion-realizada").value;
                    console.log(autoevaluacion);
                    if(autoevaluacion == 0){
                        html = `
                            <div class="switch_autoevaluacion">
                                <h2>Evaluaciones</h2>
                                <div class="evaluation-card">
                                    <div class="card">
                                        <img src="https://www.intenalco.edu.co/css/images/encabezado.autoevaluacion.png" alt="Autoevaluacion" class="card-image">
                                        <h3>Autoevaluacion</h3>
                                        <p class="description">Evaluación que permite a los equipos de trabajo evaluar el trabajo de otros equipos.<p>  
                                        <form action="{{ url('/autoevaluacion/${idEstudiante}')}}" method="GET">
                                            <button id="btn-autoevaluacion" type="submit">AUTOEVALUACIÓN</button>
                                        </form>
                                </div>
                                </div>
                            </div> `;

                    }else{
                            html = `
                    <div class="switch_autoevaluacion">
                        <h2>Evaluaciones</h2>
                        <div class="evaluation-card">
                            <div class="card">
                                <img src="https://www.intenalco.edu.co/css/images/encabezado.autoevaluacion.png" alt="Autoevaluacion" class="card-image">
                                <h3>Autoevaluacion</h3>
                                <p class="description">Evaluación que permite a los equipos de trabajo evaluar el trabajo de otros equipos.<p>  
                                
                                    <button id="btn-autoevaluacion" onclick="mensajeAutoevaluacionYaRegistrada()">AUTOEVALUACIÓN</button>
                                
                        </div>
                        </div>
                    </div> `;

                    }
                        
                        break;    
                    break;
                case 'Evaluacion_pares':
                    html = `
                <div class="switch_evaluacion_pares">
                    <h2>Evaluaciones</h2>
                    <div class="evaluation-card">
                        <div class="card">
                            <img src="https://evalart.com/wp-content/uploads/2023/01/nggallery_import/evaluacion-de-desempeno-constante-para-los-empleados_imgdest.webp" alt="Evaluación Pares" class="card-image">
                            <h3>Evaluación Pares</h3>
                            <p class="description">Evaluación que permite a los equipos de trabajo evaluar el trabajo de otros equipos.<p>  
                            <form action="" method="GET">
                                <button id="btn-evaluacion-pares" type="submit">EVALUACIÓN PARES</button>
                            </form>
                       </div>
                    </div>
                </div>
            </div>   
                `;
                    break;
                case 'evaluacion_cruzada':
                    html = `
                <div class="switch_evaluacion_cruzada">
                    <h2>Evaluaciones</h2>
                    <div class="evaluation-card">
                        <div class="card">
                            <img src="https://files.pucp.education/puntoedu/wp-content/uploads/2021/06/10190005/vri-evaluacion-grupos-de-investigacion-1920x1080-interior.jpg" alt="Evaluación Cruzada" class="card-image">
                            <h3>Evaluación Cruzada</h3>
                            <p class="description">Evaluación que permite a los equipos de trabajo evaluar el trabajo de otros equipos.<p>  
                            <form action="{{ url('/evaluacion_cruzada/1')}}" method="GET">
                                <button id="btn-evaluacion-cruzada" type="submit">EVALUACIÓN CRUZADA</button>
                            </form>
                       </div>
                    </div>
                </div> `; 
                    break;
                case 'registro_grupo_empresa':
                    html = '<h1>Registro grupo empresa</h1><p>Aquí va el contenido de registro grupo empresa.</p>';
                    break;
                default:
                    html = '<h1>Contenido</h1>';
            }
            // Cambiar el contenido dentro del main
            contenido.innerHTML = html;
            // Remover la clase 'activo' de todos los enlaces
            enlacesBarra.forEach(enlace => enlace.classList.remove('activo'));

            // Añadir la clase 'activo' al enlace que se acaba de hacer clic
            const enlaceActivo = document.querySelector(`a[onclick="cargarContenido('${seccion}')"]`);
            enlaceActivo.classList.add('activo');
        }
        function mensajeAutoevaluacionYaRegistrada(){
            console.log("Ya funciona el mensaje de restriccion");
            Swal.fire({
                icon: 'error',
                title: 'Autoevaluación ya realizada',
                text: 'Usted ya registro su autoevaluación',
                allowOutsideClick: false,
            });
        }
        
    </script>
</body>
</html>