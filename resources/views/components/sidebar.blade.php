    <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <p class="brand-link text-center">
                <span class="brand-text font-weight-bold">Assessment</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()->level == 'admin')                           
                            <li class="nav-header">MASTER</li>
                            <li class="nav-item">
                                <a href="{{ route('question.index') }}" class="nav-link {{ (request()->segment(1) == 'master' && request()->segment(2) == 'question') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-question"></i>
                                    <p>
                                        Question
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-header">ASSESSMENT</li>
                        @if (Auth::user()->level == 'user')
                        <li class="nav-item">
                            <a href="{{ route('assessment.index') }}" class="nav-link {{ (request()->segment(1) == 'form' && request()->segment(2) == 'assessment') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-check-square"></i>
                                <p>
                                    Form
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('assessment.history') }}" class="nav-link {{ (request()->segment(1) == 'form' && request()->segment(2) == 'history') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    History
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>