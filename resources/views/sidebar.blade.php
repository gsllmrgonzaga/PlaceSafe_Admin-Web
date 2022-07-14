<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

    <br>

    <br>

    <br>

    <div class="img-fluid"></div>

        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

            <li class="nav-item">

            <a href="{{ route('dashboard') }}" class="nav-link align-left px-0">

                <span class="iconify" style="color: #0c0c0c;" data-icon="eva:pie-chart-2-fill"></span>

                <span class="ms-1 d-none d-sm-inline" style="color: #0c0c0c;">Dashboard</span>

            </a>

            </li>

            <li>

                <a href="{{ route('patients') }}" class="nav-link px-0 align-middle">

                <span class="iconify" style="color: #0c0c0c;" data-icon="ic:sharp-coronavirus"></span>

                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline" style="color: #0c0c0c; font-size:18px;hover:">Covid Records</span></a>

            </li>

            <li>

                <a href="{{ route('changepassword') }}" class="nav-link px-0 align-middle">

                <span class="iconify" style="color: #0c0c0c;" data-icon="eva:lock-fill"></span>

                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline" style="color: #0c0c0c; font-size:18px;">Change Password</span> </a>

            </li>

            <hr>

        </ul>

</div>