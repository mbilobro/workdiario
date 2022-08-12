<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
<body>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Informações</div>
                            <a class="nav-link" href="leituras_umidade.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Leituras de Umidade
                            </a>
                            <a class="nav-link" href="regas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope-open"></i></div>
                                Regas
                            </a>
                            <div class="sb-sidenav-menu-heading">Histórico</div>
                            <a class="nav-link" href="historico.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Histórico
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado como:</div>
                        <?php echo $_SESSION['nome']?>
                    </div>
                </nav>
            </div>
</body>
</html>
