<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .autoevaluacion_break{
            background-color: aliceblue;
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

        .switch_visualizar_planificacion {
            max-width: 650px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_visualizar_planificacion h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_visualizar_planificacion .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_visualizar_planificacion .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_visualizar_planificacion .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_visualizar_planificacion h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_visualizar_planificacion .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_visualizar_planificacion .evaluation-form {
            margin-top: 10px;
        }

        .switch_visualizar_planificacion #btn-switch-visualizar-planificacion{
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_visualizar_planificacion #btn-switch-visualizar-planificacion:hover {
            background-color: #789bc0;
        }

        .switch_control_semanal {
            max-width: 650px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_control_semanal h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_control_semanal .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_control_semanal .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_control_semanal .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_control_semanal h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_control_semanal .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_control_semanal .evaluation-form {
            margin-top: 10px;
        }

        .switch_control_semanal #btn-switch-control-semanal{
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_control_semanal #btn-switch-control-semanal:hover {
            background-color: #789bc0;
        }

        
        .switch_planilla_evaluacion {
            max-width: 650px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        .switch_planilla_evaluacion h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .switch_planilla_evaluacion .evaluation-card {
            display: flex;
            justify-content: center;
        }

        .switch_planilla_evaluacion .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .switch_planilla_evaluacion .card-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .switch_planilla_evaluacion h3 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .switch_planilla_evaluacion .description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .switch_planilla_evaluacion .evaluation-form {
            margin-top: 10px;
        }

        .switch_planilla_evaluacion #btn-switch-planilla-evaluacion{
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .switch_planilla_evaluacion #btn-switch-planilla-evaluacion:hover {
            background-color: #789bc0;
        }
    </style>
</head>
<body>
    <input id="id-docente" type="hidden" value="{{$idDocente}}">
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
                <span>DOCENTE</span>
            </button>
        </div>

        <nav class="navegacion">
            <ul>
                <li>
                    <a id="inbox" onclick="cargarContenido('visualizar_planificacion')">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <span>Visualizar <br> planificacion</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('control_semanal')">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Control semanal</span>
                    </a>
                </li>
                <li>
                    <a onclick="cargarContenido('planilla_evaluacion')">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Planilla evaluacion</span>
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
            <h2>INICIO</h2>
            <div class="evaluation-card">
                <div class="card">
                    <h3>DOCENTE</h3>
                    <p class="description">
                        Evaluación que permite a los equipos de trabajo y a sus integrantes realizar una retroalimentación sobre su trabajo.
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
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
            let idDocente = document.getElementById('id-docente').value;
            const contenido = document.getElementById('contenido');
            let html = '';

            switch (seccion) {
                case 'visualizar_planificacion':
                    html = `
                <div class="switch_visualizar_planificacion">
                    <h2>Visualizar planificacion</h2>
                    <div class="evaluation-card">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-gratis/planificacion-empresarial-calendario_23-2149164011.jpg" alt="Autoevaluacion" class="card-image">
                            <h3>Descripcion</h3>
                            <p class="description">La visualización de la planificación de proyectos permite al docente revisar el progreso y la organización del proyecto en el taller de ingeniería de software.<p>  
                            <form action="{{ url('/visualizar_planilla_de_planificacion/0/${idDocente}')}}" method="GET">
                                <button id="btn-switch-visualizar-planificacion" type="submit">Visualizar planificacion</button>
                            </form>
                       </div>
                    </div>
                </div> 
                    `;
                    break;
                case 'control_semanal':
                    html = `                
                <div class="switch_control_semanal">
                    <h2>Seguimiento de control semanal</h2>
                    <div class="evaluation-card">
                        <div class="card">
                            <img src="https://www.revistadiabetes.org/wp-content/uploads/Insulina-semanal-para-las-personas-con-diabetes-mellitus-tipo-2.-Una-gran-rev.1-1072x675.jpg" alt="Autoevaluacion" class="card-image">
                            <h3>Descripcion</h3>
                            <p class="description">El registro de control semanal es seccionado por hitos y por hito se seccionara en semanas que tiene este hito.<p>  
                            <form action="{{ url('/cargar_registro_semanal0_${idDocente}')}}" method="GET">
                                <button id="btn-switch-control-semanal" type="submit">Control semanal</button>
                            </form>
                       </div>
                    </div>
                </div> `;
                    break;
                case 'planilla_evaluacion':
                    html = `                
                <div class="switch_planilla_evaluacion">
                    <h2>Crear planilla de evaluacion</h2>
                    <div class="evaluation-card">
                        <div class="card">
                            <img src="https://www.bizneo.com/blog/wp-content/uploads/2020/05/formato-de-evaluacion-del-desempen%CC%83o-810x455.webp" alt="planilla de evaluacion" class="card-image">
                            <h3>Descripcion</h3>
                            <p class="description">Planilla de evaluación para registrar y calificar desempeño en diversas áreas y competencias.<p>  
                            <form action="{{ url('/planilla_evaluacion/${idDocente}')}}" method="GET">
                                <button id="btn-switch-planilla-evaluacion" type="submit">Crear planilla</button>
                            </form>
                       </div>
                    </div>
                </div> `;
                    break;
                case 'notificaciones':
                    html = '<h1>Notificaciones</h1><p>Aquí va el contenido de Notificaciones.</p>';
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
    </script>
</body>
</html>