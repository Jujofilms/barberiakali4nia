<?php
//codigó para verificar que la persona si haya iniciado sesión

//iniciamos la sesión
session_start();
if (!isset($_SESSION['ingreso_admin'])) {
    //si la persona no ha iniciado sesión entonces lo redirigue al index
    header("location: ../../index.php");
    exit;
}
//fin de codigo
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel administrativo de la barberia KALI4NIA">
    <meta name="description" content="Solo puedes ingresar si ha iniciado sesión">
    <title>KALI4NIA</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <!-- header -->

    <div class="navbar">
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <a href="index.php">Panel</a>
        <a href="#servicios">Servicios</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="#agenda-completa">Agenda Completa</a>
        <a href="#mi-agenda">Mi Agenda</a>
        <a href="#caja">Caja</a>
        <a href="mi_cuenta.php">Mi Cuenta</a>
        <a href="../../php/cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>

    <!-- panel de control (valores de ingres y demas cosas) -->

    <div class="cifras">
        <div class="contenido-cifras">
            <div class="relleno-cifra">
                <h1>BARBEROS</h1>
                <h1>2001</h1>
            </div>
            <div class="relleno-cifra-1">
                <h1>CITAS</h1>
                <h1>2001</h1>
            </div>
            <div class="relleno-cifra-2">
                <h1>CITAS LISTAS</h1>
                <h1>20001</h1>
            </div>
            <div class="relleno-cifra-3">
                <h1>SERVICIOS</h1>
                <h1>2001</h1>
            </div>
            <div class="relleno-cifra-4">
                <h1>INGRESOS</h1>
                <h1>2001</h1>
            </div>
        </div>
    </div>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda nobis impedit ipsum eligendi, officiis mollitia rem a veritatis sunt temporibus sit vel veniam quas quibusdam unde quam dignissimos, aperiam eum.
    Adipisci laboriosam vel eveniet ipsa ut asperiores voluptate molestias dignissimos eligendi aliquam! Amet incidunt animi illo culpa optio exercitationem enim distinctio quam quod, perspiciatis vitae dolorem ullam? Quisquam, a velit.
    Harum necessitatibus debitis dolores odit nesciunt culpa fuga eaque impedit commodi natus reiciendis aliquam ullam, sit quas mollitia beatae iure praesentium saepe ratione sed modi. Reprehenderit dolore quia exercitationem quidem?
    Odio veritatis rerum culpa perspiciatis nihil, dignissimos delectus doloremque omnis sint fugit voluptatum cupiditate autem, fugiat amet error repellat eos pariatur dolorum! Voluptatum ducimus vel, voluptatibus sequi aliquid voluptas hic!
    Alias nostrum obcaecati totam officiis, sit reiciendis odit dolores vero praesentium temporibus hic maiores iure iste aspernatur rem itaque aut earum, excepturi, corrupti voluptatum. Ex ducimus maiores neque vitae voluptatum?
    Libero a cumque hic, alias iste esse voluptas ullam nobis vitae. A veniam sapiente laboriosam nisi nesciunt expedita reprehenderit rerum doloremque quibusdam, corporis pariatur! Vel praesentium quo obcaecati! Animi, a!
    Voluptas fuga inventore omnis accusantium blanditiis praesentium vitae similique tempora reprehenderit consequatur vel porro distinctio suscipit rem, ratione et voluptatem obcaecati laboriosam, possimus earum repellat dolorum! Cum, vitae nesciunt! Quod.
    Fugiat ullam saepe non ipsam delectus assumenda vero sed quaerat magnam suscipit adipisci consequatur veniam iste, impedit voluptatem blanditiis dolorem ea distinctio dignissimos enim eaque facilis reiciendis! Obcaecati, et explicabo.
    Inventore, ea asperiores recusandae odio ullam, nisi, et beatae distinctio quis sapiente quo! Mollitia eius facilis expedita nulla laudantium adipisci recusandae labore optio alias! Minus beatae fuga dolore! Consequatur, voluptate!
    Magnam ea dignissimos reiciendis minus maiores cum enim adipisci, dolorum corporis eveniet delectus neque dolor earum in commodi placeat, est quis libero. Cupiditate vitae assumenda odio quae dolorem in libero?
    Ratione vero aspernatur, magnam officiis repudiandae ipsam tempore omnis laboriosam accusamus similique nesciunt maxime nostrum molestiae. Incidunt quis fuga, repudiandae soluta deserunt voluptate dolorem sit suscipit provident quisquam a nisi?
    Tempore odit earum amet dolore nemo fugit beatae magni iste velit repellat asperiores quam corrupti temporibus voluptatibus et perferendis, alias quis nobis aut adipisci. At animi vero velit quia iure.
    Vitae, fuga libero quisquam corrupti minus nostrum deserunt, officiis veniam animi modi voluptatibus facilis dolor doloremque excepturi tempore quia voluptate quidem consequuntur consequatur sequi rem impedit, doloribus perferendis voluptas? Impedit?
    Nulla ullam in laboriosam, et accusamus deleniti quos rem adipisci iusto, alias expedita. Nihil praesentium doloribus dolor totam eius ut culpa repellat labore, obcaecati aut? Suscipit, odio. Libero, velit architecto?
    Vel animi ea nostrum eveniet ratione a possimus numquam itaque architecto deserunt ad in impedit, officia explicabo praesentium laudantium cum porro ex ullam, aperiam inventore quidem modi, optio accusantium? Illum.
    Accusamus iste perferendis suscipit quasi est tenetur eos incidunt, pariatur, asperiores sit doloremque harum aut, in vero ut sequi. Minus, doloribus sit! Nulla expedita minus fugiat ducimus nostrum voluptas sed.
    Harum voluptatum, sed error quibusdam necessitatibus dicta exercitationem facilis molestiae eos totam adipisci temporibus ullam minima, explicabo placeat natus doloribus rem quod, inventore consequuntur? Alias odio cupiditate sed dolores animi.
    Quo sed ex adipisci obcaecati deleniti nobis fugit corrupti repellat? Repudiandae dicta cum sit rerum magnam dignissimos, assumenda, quidem quae repellendus quia quaerat praesentium sapiente provident dolores eos labore alias.
    Ab natus magni nam voluptatibus perferendis quam in neque, dolores assumenda ipsam illum labore voluptas autem iure expedita veniam quidem earum quisquam tempora. Reprehenderit molestias corrupti natus fugit, ab laboriosam.
    Repellendus sunt vitae est iure, rerum, deserunt eaque earum, eveniet quam perspiciatis commodi? In enim, voluptatem ratione ipsum ut perspiciatis, debitis iure maxime quidem quia consequatur quisquam excepturi recusandae quas.
    Suscipit illo voluptates dolorum porro necessitatibus, nulla hic quae ea, sed autem sequi voluptatibus inventore voluptatum? Ducimus sequi deleniti saepe iure earum fugit, iste mollitia nulla dolorum eaque, accusamus nostrum!
    Non obcaecati, minus earum et ut ad esse eos ullam laudantium officia consequuntur nulla soluta. Excepturi facilis repellat suscipit voluptatibus repudiandae doloremque, nisi laborum, accusantium odit ut pariatur, animi doloribus.
    Laborum consequuntur sed quia enim qui quo, eveniet voluptate omnis modi suscipit quasi iste alias, quod neque dolorum aliquid vitae error corrupti unde eaque, illo odit ipsam aperiam eligendi. Rerum!
    Dolorum cupiditate esse nobis atque aliquam, recusandae ipsum quos corporis tempore, nesciunt molestiae voluptates. Officia ut numquam vel nam enim temporibus similique repudiandae quisquam voluptatum fuga? Fuga magnam aperiam quae.
    Enim eveniet nostrum ipsam quos? Quidem laudantium accusantium ab dicta explicabo quis asperiores accusamus architecto, exercitationem nihil voluptatum repellat praesentium? Aspernatur officiis minus quo, saepe eos est ipsa a culpa.
    Soluta ducimus animi inventore deleniti incidunt provident tenetur vero vel repellat, doloremque odit fugit, cumque quisquam blanditiis. Recusandae magnam accusantium iusto animi ipsa quasi voluptatum exercitationem repellendus et dolor! Dolorem.
    Voluptas ipsa nisi ad nulla eaque accusantium, voluptates placeat, commodi laboriosam vitae et. Voluptas, quia eveniet animi velit repellat, quasi voluptate officia porro culpa perferendis sequi. Ut quo et ea!
    Architecto, nemo consequatur. Iste nemo harum, sit dignissimos quos quae dolor repudiandae? Sequi ad neque blanditiis dolore in voluptates culpa fugit autem, eveniet voluptas, alias esse! Quam iure enim nisi.
    Ipsam eum nulla odio. Aut, placeat dolores molestias quidem ratione similique distinctio minus iusto velit incidunt assumenda veniam quis totam perferendis? Autem optio laborum illum, earum praesentium dolorum id facere?
    Distinctio, fugit praesentium? Necessitatibus, possimus atque inventore deserunt iusto accusamus doloremque expedita voluptatibus perspiciatis, nihil blanditiis ratione exercitationem rem nisi cumque. Nobis dolore velit, dignissimos nostrum libero ab deserunt odit!</p>

    <!-- script -->

    <script>
        function toggleMenu() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('show-menu');
        }
    </script>
</body>

</html>