<!-- Start Header menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <!-- <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a> -->
            <!-- <strong><a href="index.html"><img src="img/logo/logosn.png" alt="" /></a></strong> -->
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    @role('Health_care')
                    <li>
                        <a title="Landing Page" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span class="fas fa-tachometer-alt" aria-hidden="true"></span>
                            <span class="mini-click-non">Dashibodi</span>
                        </a>
                    </li>
                    <li>
                        <a title="Landing Page" href="{{ route('mother_register.index') }}" aria-expanded="false">
                            <span class="fas fa-baby" aria-hidden="true"></span>
                            <span class="mini-click-non">Mjamzito Mpya</span>
                        </a>
                    </li>
                    <li>
                        <a title="Landing Page" href="{{ route('ConversationAI.showConversation') }}" aria-expanded="false">
                            <span class="fas fa-comments" aria-hidden="true"></span>
                            <span class="mini-click-non">Mazungumzo</span>
                        </a>
                    </li>

                    <li>
                        <a title="Landing Page" href="{{ route('generatePdfReport') }}" aria-expanded="false">
                            <span class="far fa-file-alt" aria-hidden="true"></span>
                            <span class="mini-click-non">Ripoti ya siku</span>
                        </a>
                    </li>

                    <li>
                        <a title="Landing Page" href="{{ route('generateMonthlyPdfReport') }}" aria-expanded="false">
                            <span class="fa fa-line-chart" aria-hidden="true"></span>
                            <span class="mini-click-non">Ripoti ya mwezi</span>
                        </a>
                    </li>
                    @endrole
                </ul>
            </nav>
        </div>
    </nav>
</div>
