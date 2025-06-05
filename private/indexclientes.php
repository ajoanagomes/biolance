<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioLance | Painel do Paciente</title>
    
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
            --primary-light: #E3F2FD;
            --sidebar-width: 280px;
            --light: #FFFFFF;
            --dark: #263238;
            --text: #37474F;
            --text-light: #78909C;
            --success: #4CAF50;
            --warning: #FFC107;
            --danger: #F44336;
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
        
        /* Notificações */
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
        
        /* Perfil */
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
        
        .submenu {
            padding-left: 36px;
            display: none;
        }
        
        .submenu.show {
            display: block;
        }
        
        .submenu-item {
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }
        
        .menu-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .menu-toggle:after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }
        
        .menu-toggle.collapsed:after {
            transform: rotate(-90deg);
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
        
        /* Tabelas */
        .data-table {
            width: 100%;
            background: var(--light);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .data-table th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
        }
        
        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.25rem;
        }
        
        .badge-success {
            background-color: var(--success);
        }
        
        .badge-warning {
            background-color: var(--warning);
        }
        
        .badge-danger {
            background-color: var(--danger);
        }
        
        /* Formulários */
        .form-section {
            background: var(--light);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        /* Diagnóstico Rápido */
        .diagnostic-card {
            background: var(--light);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .diagnostic-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }
        
        .diagnostic-form .form-group {
            margin-bottom: 1.5rem;
        }
        
        .diagnostic-result {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: var(--primary-light);
            border-radius: 8px;
            display: none;
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
            <a class="navbar-brand" href="#">
                <img src="../private/assets/img/logo-removebg-preview[1].png" alt="Logo">
            </a>
            
            <div class="d-flex align-items-center">
                <!-- Notificações -->
                <div class="notification-wrapper">
                    <i class="fas fa-bell notification-icon"></i>
                    <span class="notification-badge">3</span>
                </div>
                
                <!-- Perfil -->
                <div class="dropdown">
                    <div class="profile-dropdown" data-bs-toggle="dropdown">
                        <img src="https://randomuser.me/api/portraits/med/men/75.jpg" class="profile-avatar" alt="Usuário">
                        <span class="profile-email" id="userEmail">paciente@example.com</span>
                        <i class="fas fa-chevron-down text-white"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fas fa-user me-2"></i> Meus Dados</a></li>
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
            <h6 class="sidebar-section-title">Meu Painel</h6>
            <a href="#" class="menu-item active" id="dashboardLink">
                <i class="fas fa-home"></i>
                <span>Visão Geral</span>
            </a>
            
            <div class="menu-item menu-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#dadosMenu">
                <span>
                    <i class="fas fa-user-circle"></i>
                    <span>Meus Dados</span>
                </span>
            </div>
            <div class="submenu collapse" id="dadosMenu">
                <a href="#" class="menu-item submenu-item" id="viewDataLink">
                    <i class="fas fa-eye"></i>
                    <span>Visualizar Dados</span>
                </a>
                <a href="#" class="menu-item submenu-item" id="editDataLink">
                    <i class="fas fa-edit"></i>
                    <span>Editar Dados</span>
                </a>
            </div>
            
            <a href="#" class="menu-item" id="appointmentsLink">
                <i class="fas fa-calendar-check"></i>
                <span>Meus Agendamentos</span>
            </a>
            
            <div class="menu-item menu-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#paymentsMenu">
                <span>
                    <i class="fas fa-credit-card"></i>
                    <span>Meus Pagamentos</span>
                </span>
            </div>
            <div class="submenu collapse" id="paymentsMenu">
                <a href="#" class="menu-item submenu-item" id="pendingPaymentsLink">
                    <i class="fas fa-clock"></i>
                    <span>Pendentes</span>
                </a>
                <a href="#" class="menu-item submenu-item" id="completedPaymentsLink">
                    <i class="fas fa-check-circle"></i>
                    <span>Concluídos</span>
                </a>
            </div>
            
            <a href="#" class="menu-item" id="reportsLink">
                <i class="fas fa-file-medical"></i>
                <span>Meus Relatórios</span>
            </a>
            
            <a href="#" class="menu-item" id="diagnosticLink">
                <i class="fas fa-stethoscope"></i>
                <span>Diagnóstico Rápido</span>
            </a>
        </div>
        
        <div class="sidebar-section support-section">
            <h6 class="sidebar-section-title">Suporte</h6>
            <a href="#" class="menu-item">
                <i class="fas fa-headset"></i>
                <span>Ajuda</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Documentação</span>
            </a>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <!-- Visão Geral (Dashboard) -->
        <div id="dashboardContent">
            <div class="welcome-header">
                <h1 class="welcome-title">Bem-vindo ao BioLance</h1>
                <p class="welcome-subtitle" id="currentDate">Segunda-feira, 5 de Junho de 2023</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">2</div>
                    <div class="stat-label">Agendamentos</div>
                    <div class="stat-subtext">Este mês</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">1</div>
                    <div class="stat-label">Pagamentos</div>
                    <div class="stat-subtext">Pendentes</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">3</div>
                    <div class="stat-label">Relatórios</div>
                    <div class="stat-subtext">Disponíveis</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">5</div>
                    <div class="stat-label">Exames</div>
                    <div class="stat-subtext">Realizados</div>
                </div>
            </div>
            
            <div class="mt-5">
                <h4 class="mb-3">Próximos Agendamentos</h4>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Procedimento</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/06/2023</td>
                                <td>14:30</td>
                                <td>Exame de Sangue</td>
                                <td><span class="badge badge-success">Confirmado</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
                                <td>20/06/2023</td>
                                <td>10:00</td>
                                <td>Ultrassonografia</td>
                                <td><span class="badge badge-warning">Pendente</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Meus Dados (Visualização) -->
        <div id="viewDataContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Meus Dados Pessoais</h1>
                <p class="welcome-subtitle">Informações do seu cadastro</p>
            </div>
            
            <div class="form-section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nome Completo</label>
                            <p class="form-control-static" id="viewFullName">João da Silva</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <p class="form-control-static" id="viewBirthDate">15/05/1985</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CPF</label>
                            <p class="form-control-static" id="viewCpf">123.456.789-00</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <p class="form-control-static" id="viewEmail">paciente@example.com</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <p class="form-control-static" id="viewPhone">(11) 98765-4321</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <p class="form-control-static" id="viewAddress">Rua Exemplo, 123 - São Paulo/SP</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button class="btn btn-primary" id="editDataBtn">Editar Dados</button>
                </div>
            </div>
        </div>
        
        <!-- Editar Dados -->
        <div id="editDataContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Editar Meus Dados</h1>
                <p class="welcome-subtitle">Atualize suas informações pessoais</p>
            </div>
            
            <div class="form-section">
                <form id="editDataForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editFullName" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="editFullName" value="João da Silva">
                            </div>
                            <div class="mb-3">
                                <label for="editBirthDate" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="editBirthDate" value="1985-05-15">
                            </div>
                            <div class="mb-3">
                                <label for="editCpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="editCpf" value="123.456.789-00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="editEmail" value="paciente@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="editPhone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="editPhone" value="11987654321">
                            </div>
                            <div class="mb-3">
                                <label for="editAddress" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="editAddress" value="Rua Exemplo, 123 - São Paulo/SP">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" id="cancelEditBtn">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Meus Agendamentos -->
        <div id="appointmentsContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Meus Agendamentos</h1>
                <p class="welcome-subtitle">Histórico e próximos compromissos</p>
            </div>
            
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="form-section-title">Próximos Agendamentos</h5>
                    <button class="btn btn-primary">Novo Agendamento</button>
                </div>
                
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Procedimento</th>
                                <th>Local</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/06/2023</td>
                                <td>14:30</td>
                                <td>Exame de Sangue</td>
                                <td>Laboratório Central</td>
                                <td><span class="badge badge-success">Confirmado</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Detalhes</button>
                                    <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>20/06/2023</td>
                                <td>10:00</td>
                                <td>Ultrassonografia</td>
                                <td>Clínica de Imagens</td>
                                <td><span class="badge badge-warning">Pendente</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Detalhes</button>
                                    <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="form-section mt-4">
                <h5 class="form-section-title">Histórico de Agendamentos</h5>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Procedimento</th>
                                <th>Local</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/05/2023</td>
                                <td>09:00</td>
                                <td>Consulta Clínica</td>
                                <td>Clínica Geral</td>
                                <td><span class="badge badge-success">Concluído</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
                                <td>22/04/2023</td>
                                <td>15:30</td>
                                <td>Raio-X</td>
                                <td>Clínica de Imagens</td>
                                <td><span class="badge badge-success">Concluído</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Pagamentos Pendentes -->
        <div id="pendingPaymentsContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Pagamentos Pendentes</h1>
                <p class="welcome-subtitle">Contas aguardando confirmação</p>
            </div>
            
            <div class="form-section">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/06/2023</td>
                                <td>Consulta Clínica - Dr. Silva</td>
                                <td>R$ 250,00</td>
                                <td>10/06/2023</td>
                                <td><span class="badge badge-warning">Aguardando</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Detalhes</button>
                                    <button class="btn btn-sm btn-success">Pagar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Pagamentos Concluídos -->
        <div id="completedPaymentsContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Pagamentos Concluídos</h1>
                <p class="welcome-subtitle">Histórico de pagamentos realizados</p>
            </div>
            
            <div class="form-section">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Método</th>
                                <th>Comprovante</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/05/2023</td>
                                <td>Exame de Sangue</td>
                                <td>R$ 180,00</td>
                                <td>Cartão Crédito</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Visualizar</button>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
                                <td>05/05/2023</td>
                                <td>Ultrassonografia</td>
                                <td>R$ 320,00</td>
                                <td>PIX</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Visualizar</button>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Meus Relatórios -->
        <div id="reportsContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Meus Relatórios</h1>
                <p class="welcome-subtitle">Resultados de exames e diagnósticos</p>
            </div>
            
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="form-section-title">Relatórios Disponíveis</h5>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Buscar relatório...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipo de Exame</th>
                                <th>Médico</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>18/05/2023</td>
                                <td>Hemograma Completo</td>
                                <td>Dr. Carlos Silva</td>
                                <td><span class="badge badge-success">Disponível</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Visualizar</button>
                                    <button class="btn btn-sm btn-outline-secondary">Download</button>
                                </td>
                            </tr>
                            <tr>
                                <td>10/05/2023</td>
                                <td>Colesterol Total</td>
                                <td>Dr. Carlos Silva</td>
                                <td><span class="badge badge-success">Disponível</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Visualizar</button>
                                    <button class="btn btn-sm btn-outline-secondary">Download</button>
                                </td>
                            </tr>
                            <tr>
                                <td>25/04/2023</td>
                                <td>Ultrassonografia Abdominal</td>
                                <td>Dra. Ana Oliveira</td>
                                <td><span class="badge badge-success">Disponível</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">Visualizar</button>
                                    <button class="btn btn-sm btn-outline-secondary">Download</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Diagnóstico Rápido -->
        <div id="diagnosticContent" style="display: none;">
            <div class="welcome-header">
                <h1 class="welcome-title">Diagnóstico Rápido</h1>
                <p class="welcome-subtitle">Informe seus sintomas para uma análise preliminar</p>
            </div>
            
            <div class="diagnostic-card">
                <h3 class="diagnostic-title">Descreva seus sintomas</h3>
                
                <form class="diagnostic-form">
                    <div class="form-group">
                        <label for="symptoms" class="form-label">Quais sintomas você está sentindo?</label>
                        <textarea class="form-control" id="symptoms" rows="3" placeholder="Descreva seus sintomas com detalhes..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="symptomDuration" class="form-label">Há quanto tempo você está com esses sintomas?</label>
                        <select class="form-select" id="symptomDuration">
                            <option value="">Selecione...</option>
                            <option value="less-than-day">Menos de 1 dia</option>
                            <option value="1-2-days">1-2 dias</option>
                            <option value="3-7-days">3-7 dias</option>
                            <option value="1-2-weeks">1-2 semanas</option>
                            <option value="more-than-2-weeks">Mais de 2 semanas</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Intensidade dos sintomas</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="intensity" id="intensity-mild" value="mild">
                            <label class="form-check-label" for="intensity-mild">Leve (não interfere nas atividades)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="intensity" id="intensity-moderate" value="moderate">
                            <label class="form-check-label" for="intensity-moderate">Moderado (interfere parcialmente)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="intensity" id="intensity-severe" value="severe">
                            <label class="form-check-label" for="intensity-severe">Grave (impossibilita atividades)</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="additionalInfo" class="form-label">Informações adicionais</label>
                        <textarea class="form-control" id="additionalInfo" rows="2" placeholder="Alergias, medicamentos em uso, condições pré-existentes..."></textarea>
                    </div>
                    
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-primary" id="analyzeSymptomsBtn">Analisar Sintomas</button>
                    </div>
                </form>
                
                <div class="diagnostic-result" id="diagnosticResult">
                    <h4>Resultado Preliminar</h4>
                    <p id="diagnosticResultText">Com base nos sintomas descritos, você pode estar com [condição]. Recomendamos [ação recomendada]. Este resultado é apenas uma orientação inicial e não substitui uma consulta médica.</p>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-primary me-2">Agendar Consulta</button>
                        <button class="btn btn-sm btn-outline-secondary">Salvar Relatório</button>
                    </div>
                </div>
            </div>
            
            <div class="diagnostic-card mt-4">
                <h3 class="diagnostic-title">Histórico de Diagnósticos</h3>
                
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Sintomas</th>
                                <th>Resultado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/05/2023</td>
                                <td>Febre, dor de garganta</td>
                                <td>Possível infecção viral</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
                                <td>22/04/2023</td>
                                <td>Dor abdominal, náuseas</td>
                                <td>Indigestão</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Detalhes</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Perfil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Meu Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="https://randomuser.me/api/portraits/med/men/75.jpg" class="rounded-circle" width="100" height="100" alt="Foto de perfil">
                        <h5 class="mt-3" id="modalUserName">João da Silva</h5>
                        <p class="text-muted" id="modalUserEmail">paciente@example.com</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">CPF</label>
                        <p class="form-control-static" id="modalUserCpf">123.456.789-00</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <p class="form-control-static" id="modalUserBirthDate">15/05/1985</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <p class="form-control-static" id="modalUserPhone">(11) 98765-4321</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Editar Perfil</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts -->
    <script>
        // Atualizar data atual
        function updateCurrentDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date();
            document.getElementById('currentDate').textContent = today.toLocaleDateString('pt-BR', options);
        }
        
        // Navegação entre seções
        function showSection(sectionId) {
            // Esconder todas as seções
            document.querySelectorAll('.main-content > div').forEach(section => {
                section.style.display = 'none';
            });
            
            // Mostrar a seção selecionada
            document.getElementById(sectionId).style.display = 'block';
            
            // Atualizar menu ativo
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Ativar o item do menu correspondente
            const menuItem = document.querySelector(`[id="${sectionId}Link"]`);
            if (menuItem) {
                menuItem.classList.add('active');
                
                // Se for um submenu, ativar o item pai também
                if (menuItem.classList.contains('submenu-item')) {
                    const parentMenu = menuItem.closest('.submenu').previousElementSibling;
                    parentMenu.classList.add('active');
                }
            }
        }
        
        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            updateCurrentDate();
            
            // Configurar navegação
            document.getElementById('dashboardLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('dashboardContent');
            });
            
            document.getElementById('viewDataLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('viewDataContent');
            });
            
            document.getElementById('editDataLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('editDataContent');
            });
            
            document.getElementById('appointmentsLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('appointmentsContent');
            });
            
            document.getElementById('pendingPaymentsLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('pendingPaymentsContent');
            });
            
            document.getElementById('completedPaymentsLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('completedPaymentsContent');
            });
            
            document.getElementById('reportsLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('reportsContent');
            });
            
            document.getElementById('diagnosticLink').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('diagnosticContent');
            });
            
            // Botão para editar dados
            document.getElementById('editDataBtn').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('editDataContent');
            });
            
            // Botão para cancelar edição
            document.getElementById('cancelEditBtn').addEventListener('click', (e) => {
                e.preventDefault();
                showSection('viewDataContent');
            });
            
            // Formulário de edição
            document.getElementById('editDataForm').addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Aqui você normalmente enviaria os dados para o servidor
                // Por enquanto, apenas atualizamos a visualização
                
                // Atualizar dados na visualização
                document.getElementById('viewFullName').textContent = document.getElementById('editFullName').value;
                
                const birthDate = new Date(document.getElementById('editBirthDate').value);
                document.getElementById('viewBirthDate').textContent = birthDate.toLocaleDateString('pt-BR');
                
                document.getElementById('viewCpf').textContent = document.getElementById('editCpf').value;
                document.getElementById('viewEmail').textContent = document.getElementById('editEmail').value;
                
                // Formatar telefone
                const phone = document.getElementById('editPhone').value;
                const formattedPhone = phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                document.getElementById('viewPhone').textContent = formattedPhone;
                
                document.getElementById('viewAddress').textContent = document.getElementById('editAddress').value;
                
                // Atualizar também no modal
                document.getElementById('modalUserName').textContent = document.getElementById('editFullName').value;
                document.getElementById('modalUserEmail').textContent = document.getElementById('editEmail').value;
                document.getElementById('modalUserCpf').textContent = document.getElementById('editCpf').value;
                document.getElementById('modalUserBirthDate').textContent = birthDate.toLocaleDateString('pt-BR');
                document.getElementById('modalUserPhone').textContent = formattedPhone;
                
                // Voltar para a visualização
                showSection('viewDataContent');
                
                // Mostrar mensagem de sucesso
                alert('Dados atualizados com sucesso!');
            });
            
            // Botão de análise de sintomas
            document.getElementById('analyzeSymptomsBtn').addEventListener('click', () => {
                // Simular análise (em um sistema real, isso seria feito no servidor)
                const symptoms = document.getElementById('symptoms').value.toLowerCase();
                let resultText = '';
                
                if (symptoms.includes('febre') && (symptoms.includes('garganta') || symptoms.includes('tosse'))) {
                    resultText = 'Com base nos sintomas descritos, você pode estar com uma infecção viral como gripe ou resfriado. Recomendamos repouso, hidratação e medicamentos para alívio dos sintomas. Se a febre persistir por mais de 3 dias ou for superior a 39°C, procure um médico.';
                } else if ((symptoms.includes('dor') && symptoms.includes('barriga')) || symptoms.includes('abdominal')) {
                    resultText = 'Seus sintomas podem indicar uma indisposição digestiva. Recomendamos uma dieta leve e observar a evolução. Se a dor for intensa ou persistir por mais de 24 horas, procure atendimento médico.';
                } else {
                    resultText = 'Com base nos sintomas descritos, recomendamos observar a evolução e procurar um médico se os sintomas persistirem ou piorarem. Este resultado é apenas uma orientação inicial e não substitui uma consulta médica.';
                }
                
                document.getElementById('diagnosticResultText').textContent = resultText;
                document.getElementById('diagnosticResult').style.display = 'block';
            });
            
            // Fechar sidebar ao clicar em um item (mobile)
            if (window.innerWidth < 992) {
                document.querySelectorAll('.menu-item').forEach(item => {
                    item.addEventListener('click', () => {
                        document.getElementById('sidebar').classList.remove('show');
                    });
                });
            }
            
            // Mostrar dashboard por padrão
            showSection('dashboardContent');
        });
    </script>
</body>
</html>