<header>
    <nav class="navbar">
        <li> <a href="/" class="home">Home</a> </li>
        <li> <a href="/grades" class="home">grades</a> </li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'teacher' ):  ?>
        <li>  <a href="/create" class="Par-mums">Izveidot</a> </li>
        <?php endif ?>
        <li> <a href="/logout" class="home">Logout</a> </li>
        
    </nav>
</header>