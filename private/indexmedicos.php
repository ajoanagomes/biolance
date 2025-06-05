<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioLance | Painel Médico</title>

    <!--Flavicon-->
    <link rel="shortcut icon" href="../private/assets/img/logocima.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #99cf84;
            --primary-dark: #99cf84;
            --primary-light: #E8F5E9;
            --sidebar-width: 280px;
            --light: #FFFFFF;
            --dark: #263238;
            --text: #37474F;
            --text-light: #78909C;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background-color: #FAFAFA;
            padding-top: 60px;
        }
        
        /* Navbar Fixa */
        .navbar-main {
            background: var(--primary) !important;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--light) !important;
            display: flex;
            align-items: center;
            font-size: 1.25rem;
        }
        
        .navbar-brand img {
            height: 32px;
            margin-right: 12px;
        }
        
        /* Notificações Melhoradas */
        .notification-wrapper {
            position: relative;
            margin-right: 1.5rem;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #FF5722;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border: 2px solid var(--primary);
        }
        
        .notification-icon {
            color: var(--light);
            font-size: 1.25rem;
            transition: all 0.2s ease;
        }
        
        .notification-icon:hover {
            transform: scale(1.1);
        }
        
        /* Perfil Melhorado */
        .profile-dropdown {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.3);
            margin-right: 10px;
            object-fit: cover;
        }
        
        .profile-email {
            color: var(--light);
            font-weight: 500;
            margin-right: 8px;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--light);
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100vh - 60px);
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1020;
            overflow-y: auto;
        }
        
        .sidebar-section {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .sidebar-section-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-light);
            margin-bottom: 1rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            color: var(--primary-dark);
            border-left: 3px solid var(--primary);
        }
        
        .menu-item i {
            margin-right: 12px;
            width: 24px;
            text-align: center;
            color: var(--text-light);
        }
        
        .menu-item.active i, .menu-item:hover i {
            color: var(--primary-dark);
        }
        
        /* Espaçamento entre seções */
        .support-section {
            margin-top: 2rem;
        }
        
        /* Conteúdo Principal */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        
        .welcome-header {
            margin-bottom: 2.5rem;
        }
        
        .welcome-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            color: var(--text-light);
            font-size: 1rem;
        }
        
        /* Grid de Cards Centralizado */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .stat-card {
            background: var(--light);
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 1rem;
            color: var(--text);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .stat-subtext {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        /* Responsividade */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Fixa -->
    <nav class="navbar navbar-main navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#indexmedicos.php">
                <img src="../private/assets/img/logo-removebg-preview[1].png" alt="Logo">
            </a>
            
            <div class="d-flex align-items-center">
                <!-- Notificações Melhoradas -->
                <div class="notification-wrapper">
                    <i class="fas fa-bell notification-icon"></i>
                    <span class="notification-badge">3</span>
                </div>
                
                <!-- Perfil Melhorado -->
                <div class="dropdown">
                    <div class="profile-dropdown" data-bs-toggle="dropdown">
                        <img src="https://randomuser.me/api/portraits/med/men/75.jpg" class="profile-avatar" alt="Dr. Silva">
                        <span class="profile-email">dr.silva@bioclance.com</span>
                        <i class="fas fa-chevron-down text-white"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Configurações</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-section">
            <h6 class="sidebar-section-title">Painel Médico</h6>
            <a href="#" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Visão Geral</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Agenda</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Meus Pacientes</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-file-medical"></i>
                <span>Fichas Clínicas</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-prescription"></i>
                <span>Prescrições</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Relatórios</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-stethoscope"></i>
                <span>Diagnósticos</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Congressos</span>
            </a>
        </div>
        
        <div class="sidebar-section support-section">
            <h6 class="sidebar-section-title">Suporte</h6>
            <a href="#" class="menu-item">
                <i class="fas fa-headset"></i>
                <span>Ajuda</span>
            </a>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="welcome-header">
            <h1 class="welcome-title">Bem-vindo, Dr. Silva</h1>
            <p class="welcome-subtitle">Segunda-feira, 5 de Junho de 2023</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">8</div>
                <div class="stat-label">Consultas Hoje</div>
                <div class="stat-subtext">Próxima: 10:30</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">3</div>
                <div class="stat-label">Relatórios Pendentes</div>
                <div class="stat-subtext">1 Urgente</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">12</div>
                <div class="stat-label">Prescrições</div>
                <div class="stat-subtext">Esta semana</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">2</div>
                <div class="stat-label">Dias para Congresso</div>
                <div class="stat-subtext">Cardiologia</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para sidebar mobile -->
    <script>
        // Simular login - substituir pelo email real do usuário
        const userEmail = localStorage.getItem('userEmail') || 'dr.silva@bioclance.com';
        document.querySelector('.profile-email').textContent = userEmail;
    </script>
</body>
</html>